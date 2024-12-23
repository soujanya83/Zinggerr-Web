<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // public function register_submit(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'full_name' => 'required|min:5',
    //         'user_name' => 'required|min:5',
    //         'email' => 'required|email',
    //         'phone' => 'required|digits:10',
    //         'password' => 'required|min:6',
    //         'tandc_status' => 'required|boolean',
    //     ]);
    //     if ($validator->fails()) {
    //         return back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $user =  User::create([
    //         'name' => $request->input('full_name'),
    //         'username' => $request->input('user_name'),
    //         'email' => $request->input('email'),
    //         'phone' => $request->input('phone'),
    //         'tandc_status' => $request->input('tandc_status'),
    //         'password' => bcrypt($request->input('password')),
    //     ]);

    //     $verificationUrl = URL::temporarySignedRoute(
    //         'verification.verify',
    //         now()->addMinutes(60),
    //         ['id' => $user->id, 'hash' => sha1($user->email)]
    //     );

    //     Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

    //     return redirect()->route('thankyou_register')->with('Registration successful! Please check your email to verify your account.');
    // }


    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        if (!hash_equals($hash, sha1($user->email))) {
            abort(403, 'Invalid verification link.');
        }
        $user->update(['email_verified_at' => now()]);
        return response()->json([
            'message' => 'Email verified successfully!'
        ]);
    }




    public function sendVerificationEmail(Request $request)
    {
        Session::put('verification_device', [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        $user = Auth::user();
        return back()->with('success', 'Verification email sent!');
    }




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
