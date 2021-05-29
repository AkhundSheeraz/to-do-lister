<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            if($emailExists > 0){
                return response()->json([
                    'status' => false,
                    'Email_error' => 'E-mail is taken'
                ]);
            }else{
                $user = new User;
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $usercreated = $user->save();
                if ($usercreated == true) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Registration Successful'
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
}
