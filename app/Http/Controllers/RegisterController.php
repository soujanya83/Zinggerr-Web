<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|min:5',
            'user_name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'password' => 'required|min:6',
            'tandc_status' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->input('full_name'),
            'username' => $request->input('user_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'tandc_status' => $request->input('tandc_status'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    // public function checkName(Request $request)
    // {
    //     $exists = User::where('name', $request->input('full_name'))->exists();
    //     return response()->json(['exists' => $exists]);
    // }

    public function checkUsername(Request $request)
    {

        $exists = User::where('username', $request->input('username'))->exists();
        return response()->json(['exists' => $exists]);
    }

    public function checkPhone(Request $request)
    {
        $exists = User::where('phone', $request->input('phone'))->exists();
        return response()->json(['exists' => $exists]);
    }

    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->input('email'))->exists();
        return response()->json(['exists' => $exists]);
    }
    public function checkField(Request $request, $field)
    {
        $exists = User::where($field, $request->get($field))->exists();
        return response()->json(['exists' => $exists]);
    }
}
