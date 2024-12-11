<?php

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
