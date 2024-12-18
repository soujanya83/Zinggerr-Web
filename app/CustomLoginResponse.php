<?php

namespace App;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
class CustomLoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        return redirect()->route('dashboard');
    }
    // public function toResponse($request): RedirectResponse
    // {
    //     return redirect()->route('dashboard'); // Redirect to dashboard after login
    // }
}
