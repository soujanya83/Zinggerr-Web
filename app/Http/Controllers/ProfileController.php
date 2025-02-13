<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProfileController extends Controller
{

    public function set_new_password(Request $request){
        dd($request);
    }

    public function submitOtp(Request $request)
    {

        // Validate the OTP input
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $email = session()->get('otp_identifier_email');

        if (!$email) {
            return back()->with('error', 'Session expired. Please request a new OTP.');
        }

        // Find the OTP record linked to the stored email
        $otpRecord = ResetPassword::where('email', $email)
            ->where('token', $request->otp)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5)) // OTP valid for 5 minutes
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'Invalid or expired OTP. Please try again.');
        }

        // Find the user associated with this email
        $user = User::where('email', $email)->whereNotNull('email_verified_at')->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // $otpRecord->delete();

        // session()->forget('otp_identifier_email');

        return redirect()->route('password.reset.form')->with('success', 'OTP verified successfully! Set your new password.');
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('email', $request->identifier)
            ->orWhere('phone', $request->identifier)
            ->orWhere('username', $request->identifier)
            ->first();

        if (!$user) {
            return back()->with('error', 'User not found!');
        }
        $otp = rand(100000, 999999);
        ResetPassword::updateOrInsert(
            ['email' => $user->email],
            ['token' => $otp, 'created_at' => Carbon::now()]
        );
        $this->sendOtpMail($user, $otp);

        // Store identifier in session for verification
        session()->put('otp_identifier_email', $user->email);
        return redirect()->route('otp.verify')->with('success', 'OTP sent to your email.');
    }

    private function sendOtpMail($user, $otp)
    {
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
            "htmlbody" => view('auth.passwords.otp_email', [
                'userName' => $user->name,
                'otp' => $otp,

            ])->render()
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
            return false;
        } else {
            return true;
        }
    }

    // private function sendOtpMail($user)
    // {
    //     // Render the Blade template into HTML
    //     $verificationUrl = route('verification.verify', [
    //         'id' => $user->id,
    //         'hash' => sha1($user->getEmailForVerification())
    //     ]);

    //     $postData = [
    //         "from" => ["address" => "noreply@zinggerr.com"],
    //         "to" => [
    //             [
    //                 "email_address" => [
    //                     "address" => $user->email,
    //                     "name" => $user->name
    //                 ]
    //             ]
    //         ],
    //         "subject" => "Verify Your Email",
    //         "htmlbody" => view('emails.email_verify', [
    //             'userName' => $user->name,
    //             'verificationUrl' => $verificationUrl
    //         ])->render() // Convert Blade view to HTML string
    //     ];

    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://api.zeptomail.com.au/v1.1/email",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => json_encode($postData),
    //         CURLOPT_HTTPHEADER => [
    //             "accept: application/json",
    //             "authorization: Zoho-enczapikey GkDdjPiC+lYbwFqX8426YIQGbJRi7cDiHJq2MZ9SoBN+vtwJ4UxNeZVLwnAkyzBNuiHIBVfBd7tz8THZsO6OfXMrJSqrcETuOpwzGB+edd0FvHvXUPi/9/tgVkjNnvCoNQtu7RIy9Ctv4A==",
    //             "content-type: application/json",
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);

    //     if ($err) {

    //         // Log::error("ZeptoMail Error: " . $err);
    //         return false;
    //     } else {

    //         $verificationUrl = route('verification.verify', [
    //             'id' => $user->id,
    //             'hash' => sha1($user->getEmailForVerification())
    //         ]);
    //         // Log::info("ZeptoMail Response: " . $response);
    //         return true;
    //     }
    // }






    public function profilepage(Request $request)
    {
        return view('profiles.profile_page');
    }

    public function socialprofilepage(Request $request)
    {
        return view('profiles.socialprofile_page');
    }



    public function updateProfile(Request $request)
    {
        $uid = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:10',
            'username' => 'nullable|string|min:6',
            'gender' => 'required|in:Male,Female,Other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $user = User::findOrFail($uid);

            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'username' => $request->username,
            ]);


            if ($request->hasFile('profile_picture')) {

                // if ($user->profile_picture) {
                //     Storage::disk('public')->delete('users_pictures/' . $user->profile_picture);
                // }


                $imagePath = $request->file('profile_picture')->store('users pictures', 'public');
                $user->update(['profile_picture' => $imagePath]);
            }

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // \Log::error('Error in updateProfile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $uid = Auth::user()->id;
        $user = User::findOrFail($uid);

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            // Return with an error message for current_password
            return redirect()->back()
                ->withErrors(['current_password' => 'The current password is incorrect.'])
                ->withInput();
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
