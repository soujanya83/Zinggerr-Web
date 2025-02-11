<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    public function create(array $input): User
    {
        Validator::make($input, [
            'full_name' => ['required', 'string', 'min:5'],
            'user_name' => [
                'required',
                'string',
                'min:5',
                Rule::unique('users', 'username'),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'phone' => [
                'required',
                'digits:10',
                Rule::unique('users', 'phone'),
            ],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();

        $uuid = (string) Guid::uuid4();
        $user = User::create([
            'id' => $uuid,
            'remember_token' => $input['_token'],
            'name' => $input['full_name'],
            'username' => $input['user_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'status' => 1,
            'password' => Hash::make($input['password']),
        ]);

        // Generate Email Verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // Send Email Verification with Blade Template
        $this->sendZeptoMail($user, $verificationUrl);
        session()->put('registered_email', $user->email);
        event(new Registered($user));
        return $user;
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

}
