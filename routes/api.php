<?php

use App\Http\Controllers\BigBlueButtonController;
use Illuminate\Support\Facades\Route;

Route::post('/meetings/create', [BigBlueButtonController::class, 'createMeeting']);
Route::get('/meetings/join', [BigBlueButtonController::class, 'joinMeeting']);
Route::post('/meetings/end', [BigBlueButtonController::class, 'endMeeting']);
Route::get('/meetings/recordings', [BigBlueButtonController::class, 'getRecordings']);
