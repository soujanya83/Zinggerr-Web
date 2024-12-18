<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    // public function login(Request $request)
    // {
    //     // Validate input fields
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'login' => 'required',
    //             'password' => 'required'
    //         ]
    //     );

    //     // If validation fails, return with errors
    //     if ($validator->fails()) {
    //         return back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // Retrieve the login value (either phone, email, or username)
    //     $login = $request->login;
    //     $password = $request->password;

    //     // Search for user by any of the login fields
    //     $user = User::where('phone', $login)
    //         ->orWhere('email', $login)
    //         ->orWhere('username', $login)
    //         ->first();

    //     // Check if the user exists and the password matches
    //     if ($user && Hash::check($password, $user->password)) {
    //         auth()->login($user);

    //         // Redirect based on the user's role
    //         return redirect($this->redirectDash())->with('success', 'Login successful!');
    //     }

    //     // If login fails
    //     return redirect()->route('login')->with('error', 'Invalid login credentials.');
    // }



    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
