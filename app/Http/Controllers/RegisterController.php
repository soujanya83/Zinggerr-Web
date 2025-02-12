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
use Illuminate\Auth\Events\Verified;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        if (Carbon::parse($user->created_at)->addMinutes(3)->isPast()) {
            return view('emails.link_expired', compact('id')); // Show expired link page
        }
        if (!hash_equals((string) $hash, sha1($user->email))) {
            abort(403, 'Invalid verification link.');
        }
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }
        return view('emails.thank_you'); // Show Thank You page
    }


    public function resend_email_verification($id)
    {
        $user = User::findOrFail($id);

        // Update created_at to reset expiration time, but DO NOT mark email as verified
        $user->update(['created_at' => now()]);

        // Generate new Email Verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60), // Link expires in 60 minutes
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // Resend verification email
        $this->sendZeptoMail($user, $verificationUrl);
        session()->put('registered_email', $user->email);
        return redirect()->route('thankyou_register')->with('success', 'A new verification email has been sent.');
    }

    private function sendZeptoMail($user, $verificationUrl)
    {
        // Render the Blade template into HTML
        $verificationUrl = route('verification.verify', [
            'id' => $user->id,
            'hash' => sha1($user->getEmailForVerification())
        ]);

        $postData = [
            "from" => ["address" => "noreply@zinggerr.com"],
            "to" => [
                [
                    "email_address" => [
                        "address" => $user->email,
                        "name" => $user->name
                    ]
                ]
            ],
            "subject" => "Verify Your Email",
            "htmlbody" => view('emails.email_verify', [
                'userName' => $user->name,
                'verificationUrl' => $verificationUrl
            ])->render() // Convert Blade view to HTML string
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.zeptomail.com.au/v1.1/email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Zoho-enczapikey GkDdjPiC+lYbwFqX8426YIQGbJRi7cDiHJq2MZ9SoBN+vtwJ4UxNeZVLwnAkyzBNuiHIBVfBd7tz8THZsO6OfXMrJSqrcETuOpwzGB+edd0FvHvXUPi/9/tgVkjNnvCoNQtu7RIy9Ctv4A==",
                "content-type: application/json",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {

            // Log::error("ZeptoMail Error: " . $err);
            return false;
        } else {

            $verificationUrl = route('verification.verify', [
                'id' => $user->id,
                'hash' => sha1($user->getEmailForVerification())
            ]);
            // Log::info("ZeptoMail Response: " . $response);
            return true;
        }
    }



    // public function sendVerificationEmail(Request $request)
    // {
    //     Session::put('verification_device', [
    //         'ip' => $request->ip(),
    //         'user_agent' => $request->userAgent(),
    //     ]);
    //     $user = Auth::user();
    //     return back()->with('success', 'Verification email sent!');
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
