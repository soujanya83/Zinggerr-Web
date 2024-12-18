<?php

namespace App;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        return redirect()->route('dashboard');
    }
}
