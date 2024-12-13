<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'login' => 'required',
                'password' => 'required'
            ]
        );
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $login=$request->login;
        $password=$request->password;

        $user = User::where('phone', $login)
        ->orWhere('email', $login)
        ->orWhere('username', $login)
        ->first();
    if ($user && Hash::check($password, $user->password)) {
        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Login successful!');
    }
    return redirect()->route('login')->with('error', 'Invalid login credentials.');

    }




}
