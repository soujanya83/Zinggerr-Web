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
        $user = Auth::user(); // Get the authenticated user

        // Check user role and redirect accordingly
        switch ($user->type) {
            case 'Superadmin':
                return redirect()->route('dashboard'); ////////////// this defalut user superadmin
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            case 'Student':
                return redirect()->route('student.dashboard');
            default:
                return redirect()->route('default.dashboard'); // Fallback route
        }
    }
}
