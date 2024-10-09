<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\OldPassword;

class ResetPasswordController extends Controller
{

        public function showResetForm(Request $request, $token)
        {
            return view('auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
        }

        public function reset(Request $request)
        {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            $user = User::where("email",$request->email)->first();
            $latestPassword = OldPassword::where('user_id',$user->id)->orderBy('created_at', 'desc')->take(4)->get();
            foreach ($latestPassword as $key => $value) {
                if (password_verify($request->password,$value->password)) {
                    return back()->withErrors(["password" => "Password sudah pernah dipakai"]);
                }
            }

            $response = $this->broker()->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->save();

                    $user->setRememberToken(Str::random(60));
                }
            );

            return $response == Password::PASSWORD_RESET
                ? view('verifReset')
                : back()->withErrors(['email' => trans($response)]);
        }

        protected function broker()
        {
            return Password::broker();
        }
    }
