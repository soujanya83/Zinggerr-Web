<?php

namespace App;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class CustomRegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {

        return redirect('/thank-you');
    }
}
