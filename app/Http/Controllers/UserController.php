<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\OldPassword;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $u = DB::table('users')->where('email',$request->email)->first();
        if($u){
            return back()->withErrors("Maaf, Alamat Email sudah terdaftar, coba alamat email lain!.");
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
        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $remember = $request->has('remember');
        // mengecek apakah checkbox "Ingat Saya" sudah ter centang
        if (Auth::attempt([$field => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route("index");
            // Meneruskan ke route utama
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    public function register(Request $request){
        return view('register');
    }

    public function updateUser(Request $request, $id) {
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
