<?php

namespace App;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CustomLoginResponse implements LoginResponseContract
{

    // public function toResponse($request)
    // {

    //     return redirect()->route('dashboard');
    // }
    public function toResponse($request)
    {

        $user = Auth::user();


        if (Auth::check()) {
            switch ($user->type) {
                case 'Superadmin':
                    return redirect()->route('dashboard'); ////////////// this defalut user superadmin
                case 'Admin':
                    return redirect()->route('dashboard');
                case 'Teacher':
                    return redirect()->route('teacher.dashboard');
                case 'Staff':
                    return redirect()->route('dashboard');
                case 'Student':
                    return redirect()->route('student.dashboard');
                default:
                    return redirect()->route('default.dashboard'); // Fallback route
            }
        }
    }
}
