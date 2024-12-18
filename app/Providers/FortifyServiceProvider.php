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
        Fortify::authenticateUsing(function (Request $request) {
            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);
            $user = User::where('email', $request->email)
                ->orWhere('phone', $request->email)
                ->orWhere('username', $request->email)
                ->first();

            Log::info('Attempting login for: ' . $request->email);
            // Log::info(session()->all());

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
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
