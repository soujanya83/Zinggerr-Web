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

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {

        // Validate input data
        Validator::make($input, [
            'full_name' => ['required', 'string', 'min:5'],
            'user_name' => ['required', 'string', 'min:5'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'phone' => ['required', 'digits:10'],
            'password' => ['required', 'string', 'min:6'],
            'tandc_status' => ['required', 'boolean'],
        ])->validate();

        // Create the user
        $user = User::create([
            'name' => $input['full_name'],
            'username' => $input['user_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'tandc_status' => $input['tandc_status'],
            'password' => Hash::make($input['password']),
        ]);

        // Send Email Verification
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

      
        event(new Registered($user));

        return $user;
    }
}
