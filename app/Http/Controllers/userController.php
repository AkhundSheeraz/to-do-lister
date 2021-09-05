<?php

namespace App\Http\Controllers;

use App\Jobs\sendverification_mail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class userController extends Controller
{
    public function registerUser(Request $request)
    {
        $data = $request->all();
        $rules = [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'regex:/^.+@.+$/i'],
            'password' => ['required', 'confirmed', 'min:6', 'max:16'],
            'password_confirmation' => ['required', 'min:6', 'max:16']
        ];
        $errors = [
            'firstname.required' => 'First Name required!',
            'lastname.required' => 'Last Name required!',
            'email.required' => 'E-mail required!',
            'email.required.regex:/^.+@.+$/i' => 'E-mail must have @ .',
            'password.required' => 'Password required!',
            'password.min' => 'Password too short!',
            'password.max' => 'Password too long!',
            'password.confirmed' => 'Password un-match error!',
            'password_confirmation.required' => 'Password required!',
            'password_confirmation.min' => 'Password too short',
            'password_confirmation.max' => 'Password too long',
            'password_confirmation.confirmed' => 'Password un-match error!'
        ];
        $validator = Validator::make($data, $rules, $errors);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $emailExists = User::where('email', $request->email)->count();
            if ($emailExists > 0) {
                return response()->json([
                    'status' => false,
                    'Email_error' => 'E-mail is taken'
                ]);
            } else {
                $user = new User;
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $usercreated = $user->save();
                if ($usercreated == true) {
                    sendverification_mail::dispatch($user);
                    Auth::login($user);
                    return response()->json([
                        'status' => true,
                        'message' => 'Account Created'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Registration Failed'
                    ]);
                }
            }
        }
    }

    public function loginUser(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => ['required', 'regex:/^.+@.+$/i'],
            'password' => ['required']
        ];
        $errors = [
            'email.required' => 'Email Required!',
            'password.required' => 'Password Required'
        ];
        $validator = Validator::make($data, $rules, $errors);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $email_Exists = User::where('email', $request->email)->count();
            if ($email_Exists > 0) {
                // No need to fetch and validate use Auth Attempt for session
                $credentials = $request->only(['email', 'password']);
                if (Auth::attempt($credentials)) {
                    return response()->json([
                        'status' => true,
                        'message' => 'http://my-app.test/home'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'authentication' => 'Wrong Password!'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'Email_error' => "E-mail does'nt exists!"
                ]);
            }
        }
    }

    public function resend_Verification_mail(Request $request)
    {

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function reset_Passwords(Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'email']
        ], [
            'email.required' => 'E-mail is Required!'
        ]);
        $status = Password::sendResetLink($validation);
        return $status === Password::RESET_LINK_SENT
            ? response()->json([
                'status' => true,
                'message' => __($status)
            ])
            : response()->json([
                'status' => false,
                'email' => __($status)
            ]);
    }

    public function set_new_password(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6']
        ], [
            'token.required' => 'token is required!',
            'email.required' => 'Email is required!',
            'email.email' => 'email should have @',
            'password.required' => 'password is required!',
            'password.confirmed' => 'password un-match error!',
            'password.min' => 'password too short!',
            'password_confirmation.required' => 'password is required!',
            'password_confirmation.min' => 'password too short!'
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? response()->json([
                'status' => true,
                'message' => __($status)
            ])
            : response()->json([
                'status' => false,
                'message' => __($status)
            ]);
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function microsoft()
    {
        //doesn't work
        return Socialite::driver('azure')->redirect();
    }

    public function microsoft_redirect()
    {
        //code here
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_redirect()
    {
        $user =  Socialite::driver('google')->user();
        $usermail_exists = User::where('email', $user->email)->count();
        if ($usermail_exists > 0) {
            $userID = User::where('email', $user->email)->get();
            $id = $userID[0]->id;
            Auth::loginUsingId($id);
            return redirect('home');
        } else {
            return redirect('register')->with('data', $user);
        }
    }
}
