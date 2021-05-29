<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'password' => ['required', 'confirmed', 'min:6','max:16'],
            'password_confirmation' => ['required', 'min:6','max:16']
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
        $validator = Validator::make($data,$rules,$errors);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->toArray()
            ]);
        }else{
            return response()->json([
                'status' => true
            ]);
        }


        // $validation = $request->validate([
        //     'firstname' => ['required'],
        //     'lastname' => ['required'],
        //     'email' => ['required', 'regex:/^.+@.+$/i'],
        //     'password' => ['required', 'min:6|max:12'],
        //     'password2' => ['required']
        // ]);

        // return $validation;

        // if ($request->has(['firstname', 'lastname', 'email', 'password', 'password2'])) {
        //     $firstname = $request->firstname;
        //     $lastname = $request->lastname;
        //     $email = $request->email;
        //     $password = $request->password;
        //     $password2 = $request->password2;
        //     if ($password == $password2) {
        //         return ['message' => 'Password match'];
        //     } else {
        //         return ['message' => 'Password not matching'];
        //     }
        // } else {
        //     return ['message' => 'Registration Failed'];
        // }
    }
}
