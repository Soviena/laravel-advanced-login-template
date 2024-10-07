<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
        return redirect()->route('login');
    }

    public function index(Request $request){
        $user = Auth::user()->load('user_data');

        return view('index', compact('user'));
    }
    public function login(Request $request){
        return view('login');
    }

    public function loginFunc(Request $request){
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        // mengecek apakah checkbox "Ingat Saya" sudah ter centang
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route("index");
            // Meneruskan ke route utama
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    public function register(Request $request){
        return view('register');
    }

    public function logOut(Request $request){
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
