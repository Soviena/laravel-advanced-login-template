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
        $users->email = strtolower($request->email);
        $users->tanggal_lahir = $request->tanggal_lahir;
        $users->password = $request->password;
        if ($request->hasFile('file_profile')) {
            $file_profile = $request->file('file_profile');
            $file_profile->storeAs('public/uploaded/user/',$file_profile->hashName());
            $users->profilepic = $file_profile->hashName();
        }
        $users->save();
        $users->sendEmailVerificationNotification();
        return redirect()->route('manageUser');
    }
}
