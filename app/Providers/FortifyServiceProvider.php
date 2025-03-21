<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\CustomRegisterResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Redirect;
use App\CustomLoginResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Events\Login;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as BaseController;
use Illuminate\Auth\AuthenticationException;
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->extend(BaseController::class, function ($baseController) {
            return app(AuthenticatedSessionController::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);


        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });


        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });
        // Fortify::authenticateUsing(function (Request $request) {
        //     $request->validate([
        //         'login' => ['required'],
        //         'password' => ['required'],
        //     ]);

        //     $user = User::where('status', 1)->where('email_verified_at', '!=', null)
        //         ->where(function ($query) use ($request) {
        //             $query->where('email', $request->login)
        //                 // ->orWhere('phone', $request->login)
        //                 ->orWhere('username', $request->login);
        //         })
        //         ->first();
        //     if ($user && Hash::check($request->password, $user->password)) {
        //         return $user;
        //     }
        //     $resetPasswordStatus = User::where('reset_password_status', 0)->first();
        //     if ($resetPasswordStatus) {
        //         return view('auth.passwords.newpassword_set');
        //     }


        //     return null;
        // });

        Fortify::authenticateUsing(function (Request $request) {
            $request->validate([
                'login' => ['required'],
                'password' => ['required'],
            ]);

            // First, find the user by email or username
            $user = User::where(function ($query) use ($request) {
                $query->where('email', $request->login)
                      ->orWhere('username', $request->login);
            })->first();

            // If the user doesn't exist or the password is incorrect, return null to show the default error
            if (!$user || !Hash::check($request->password, $user->password)) {
                return null; // This will trigger Fortify's default error: "These credentials do not match our records."
            }

            // If the password is correct, check reset_password_status
            if ($user->reset_password_status == 0) {
                // Store the user's email in the session for the reset form
                $request->session()->put('otp_identifier_email', $user->email);
                // Throw an exception to redirect to the password reset page
                throw new AuthenticationException('Password reset required.', [], route('password.newpassword'));
            }

            // If reset_password_status is not 0, proceed with other checks and allow login
            if ($user->status == 1 && !is_null($user->email_verified_at)) {
                return $user; // Login successful
            }

            // If status != 1 or email_verified_at is null, return null to fail authentication
            return null;
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.passwords.request');
        });


        // Fortify::logoutUsing(function () {
        //     // Redirect to login page after logout
        //     return redirect()->route('login');
        // });


    }
}
