<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function useradd(Request $request)

    {
        return view('users.useradd');
    }
    public function userlist(Request $request)

    {
        return view('users.userlist');
    }
}
