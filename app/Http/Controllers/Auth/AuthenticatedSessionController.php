<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class AuthenticatedSessionController extends BaseController
{

    protected function authenticated(Request $request, $user)
    {
        return redirect('/dashboard');
    }


}
