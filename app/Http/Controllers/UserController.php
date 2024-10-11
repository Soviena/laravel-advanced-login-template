<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\OldPassword;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateInterval;


class UserController extends Controller
{
    public function create(Request $request){
        if ($request->password != $request->confirm_password) {
            return back()->with(["error" => "Konfirmasi password salah"]);
        };
        $request->validate([
            'email' => 'required|email',
        ]);
        $u = DB::table('users')->where('email',$request->email)->first();
        if($u){
            return back()->with(["error" => "Sudah Terdaftar"]);
        }
        $users = new User;
        $users->username = $request->username;
        $users->email = strtolower($request->email);
        $users->password = $request->password;
        $users->save();
        $users->refresh();

        $userData = new UserData;
        $userData->first_name = $request->first_name;
        $userData->last_name = $request->last_name;
        $userData->gender = $request->gender;
        $userData->phone_number = $request->phone_number;
        $userData->date_of_birth = $request->tanggal_lahir;
        $userData->user()->associate($users);
        $userData->save();
        $users->sendEmailVerificationNotification();

        $oldPassword = new OldPassword;
        $oldPassword->user()->associate($users);
        $oldPassword->password = $users->password;
        $oldPassword->save();
        return redirect()->route('login');
    }

    public function index(Request $request){
        $user = Auth::user()->load('user_data');
        $users = User::all();
        return view('index', compact('user','users'));
    }
    public function login(Request $request){
        return view('login');
    }

    public function loginFunc(Request $request){
        $now = new DateTime();
        $oneHourLater = new DateTime();
        $oneHourLater->add(new DateInterval('PT1H'));

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $u = User::where($field,$request->email)->first();
        if(!$u){
            return back()->withErrors(["error" => "Tidak terdaftar!!"]);
        }
        if (!is_null($u->unblocked_at) && $u->unblocked_at >= $now) {
            $u->unblocked_at = $oneHourLater;
            $u->save();
            return back()->withErrors(["blocked" => "Akun anda di blokir"]);
        }
        $remember = $request->has('remember');

        if (Auth::attempt([$field => $request->email, 'password' => $request->password], $remember)) {
            $u->consecutive_login_end_at = $oneHourLater;
            $u->save();
            return redirect()->route("index");
            // Meneruskan ke route utama
        }

        if (is_null($u->consecutive_login_end_at)) {
            $u->consecutive_login_end_at = $oneHourLater;
        }
        if ($u->consecutive_login_end_at >= $now) {
            $u->failed_counter = $u->failed_counter + 1;
        }else{
            $u->failed_counter = 1;
        }
        if ($u->failed_counter >= 3) {
            $u->unblocked_at = $oneHourLater;
            $u->save();
            return back()->withErrors(["blocked" => "Akun anda di blokir"]);
        }
        $u->consecutive_login_end_at = $oneHourLater;
        $u->save();
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    public function register(Request $request){
        return view('register');
    }

    public function updateUser(Request $request, $id) {
        if ($request->password != $request->confirm_password) {
            return back()->with(["error" => "Konfirmasi password salah"]);
        };
        $user = User::findOrFail($id);
        if (!password_verify($request->old_password,$user->password)) {
            return back()->with(["error" => "Password lama salah"]);
        }
        if ($user->username != $request->username) {
            $u = DB::table('users')->where('username',$request->username)->first();
            if($u){
                return back()->with(["error" => "Username sudah terdaftar coba lagi yang lain!"]);
            }
            $user->username = $request->username;
        }
        if ($user->email != $request->email) {
            $u = DB::table('users')->where('email',$request->email)->first();
            if($u){
                return back()->with(["error" => "Email sudah terdaftar coba lagi yang lain!"]);
            }
            $user->email = strtolower($request->input('email'));
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }
        if ($request->password != '') {
            $latestPassword = OldPassword::where('user_id',$id)->orderBy('created_at', 'desc')->take(4)->get();
            foreach ($latestPassword as $key => $value) {
                if (password_verify($request->password,$value->password)) {
                    return back()->with(["error" => "Password sudah pernah dipakai"]);
                }
            }
            $user->password = $request->password;
            $oldPassword = new OldPassword;
            $oldPassword->user()->associate($user);
            $oldPassword->password = $user->password;
            $oldPassword->save();
        }
        $user->save();
        return redirect()->back()->with(["EditSuccess" => "Data diri berhasil diubah"]);
    }

    public function profile(Request $request){
        $user = Auth::user()->load('user_data');

        return view('profile', compact('user'));
    }

    public function logOut(Request $request){
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
