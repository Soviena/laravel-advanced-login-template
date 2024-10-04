<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


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
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->gender = $request->gender;
        $users->phone_number = $request->phone_number;
        $users->email = strtolower($request->email);
        $users->date_of_birth = $request->tanggal_lahir;
        $users->password = $request->password;
        $users->save();
        $users->sendEmailVerificationNotification();
        return redirect()->route('login');
    }
}
