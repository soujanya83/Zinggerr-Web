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
                Rule::unique('users', 'username'), // Unique validation for username
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email'), // Unique validation for email
            ],
            'phone' => [
                'required',
                'digits:10',
                Rule::unique('users', 'phone'), // Unique validation for phone
            ],
            'password' => ['required', 'string', 'min:6'],
            // 'tandc_status' => ['required', 'boolean'],
        ])->validate();


        $uuid = (string) Guid::uuid4();
        $user = User::create([
            'id'=>$uuid,
            'remember_token'=>$input['_token'],
            'name' => $input['full_name'],
            'username' => $input['user_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'status' => 1,
            // 'tandc_status' => $input['tandc_status'],
            'password' => Hash::make($input['password']),
        ]);

        // Send Email Verification
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

        session()->put('registered_email',$user->email );
        event(new Registered($user));

        return $user;
    }
}
