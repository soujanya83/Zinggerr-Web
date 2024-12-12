<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('app.dashboard');
})->name('dashboard');

Route::get('/courses', function () {
    return view('app.courses.list');
})->name('courses');

Route::get('/courses/add', function () {
    return view('app.courses.add');
})->name('addCourse');

Route::get('/register-page', function () {
    return view('auth.register');
})->name('user_register');

Route::post('register-submit', [RegisterController::class, 'register_submit'])->name('register_submit');

// Route::post('/check-name', [RegisterController::class, 'checkField'])->name('check.name')->defaults('field', 'name');
Route::post('/check-username', [RegisterController::class, 'checkUsername'])->name('check.username')->defaults('field', 'username');
Route::post('/check-phone', [RegisterController::class, 'checkPhone'])->name('check.phone');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');
