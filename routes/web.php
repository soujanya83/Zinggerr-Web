<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/app', function () {
        return view('app.dashboard');
    })->name('dashboard');
});

// Route::get('/courses', function () {
//     return view('app.courses.list');
// })->name('courses');

Route::get('/courses/add', function () {
    return view('app.courses.add');
})->name('addCourse');

Route::get('/register-page', function () {
    return view('auth.register');
})->name('user_register');

Route::get('/login-page', function () {
    return view('auth.login');
})->name('user_login');

Route::get('/thankyou-page', function () {
    return view('auth.thankyou_register');
})->name('thankyou_register');

Route::post('register-submit', [RegisterController::class, 'register_submit'])->name('register_submit');

// Route::post('/check-name', [RegisterController::class, 'checkField'])->name('check.name')->defaults('field', 'name');
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



Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verify'])
    ->name('verification.verify');


Route::middleware(['web'])->group(function () {
    Route::post('/login-page', [LoginController::class, 'login'])->name('login.submit');
});

Route::post('courses-create', [CourseController::class, 'createCourse'])->name('courses_create');
Route::match(['get', 'post'], 'courses', [CourseController::class, 'courselist'])->name('courses');
Route::get('courses/{id}', [CourseController::class, 'coursedetails'])->name('course_details');

Route::get('courses-edit/{id}', [CourseController::class, 'courseedit'])->name('course_edit');
Route::post('courses-update/{id}', [CourseController::class, 'courseupdate'])->name('course_update');

Route::get('/courses-delete/{id}', [CourseController::class, 'coursedelete'])
    ->name('course_delete')
    ->middleware('can:role');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
