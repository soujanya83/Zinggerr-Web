<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\ClearCacheAfterLogout;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('login');
})->name('logout');

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard'); // Redirect logged-in users
    }
    return view('auth.login');
})->name('login');


// ................................................use email verify..........................................
Route::get('/email', function () {
    return view('emails.email_verify');
})->name('user_email');

Route::get('/thank-you', function () {
    return view('auth.thankyou_register');
})->name('thankyou_register');

Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verify'])
    ->name('verification.verify');

Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username')->defaults('field', 'username');
Route::post('/check-phone', [RegisterController::class, 'checkPhone'])->name('check.phone');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');

/////////////////////////////////////use for mail testing only/////////////////////////////////////////
// Route::get('/test-email', function () {
//     Mail::raw('This is a test email sent using Gmail SMTP.', function ($message) {
//         $message->to('chandantafi1996@gmail.com')
//                 ->subject('Test Email from Laravel');
//     });
//     return 'Test email sent successfully!';
// });
////////////////////////////////////////////////////////////////////////////////////////////////////





Route::middleware(['web', ClearCacheAfterLogout::class, 'auth'])->group(function () {
    Route::get('/app', function () {
        return view('app.dashboard');
    })->name('app');

    Route::get('/dashboard', function () {
        return view('app.dashboard');
    })->name('dashboard');

    Route::post('courses-create', [CourseController::class, 'createCourse'])->name('courses_create');
    Route::match(['get', 'post'], 'courses', [CourseController::class, 'courselist'])->name('courses');
    Route::get('courses/{id}', [CourseController::class, 'coursedetails'])->name('course_details');

    Route::get('courses-edit/{id}', [CourseController::class, 'courseedit'])->name('course_edit');
    Route::post('courses-update/{id}', [CourseController::class, 'courseupdate'])->name('course_update');

    Route::get('/courses-delete/{id}', [CourseController::class, 'coursedelete'])
        ->name('course_delete')
        ->middleware('can:role');
    Route::get('/courses/add', function () {
        return view('app.courses.add');
    })->name('addCourse');



    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('login');
    })->name('logout');
});
