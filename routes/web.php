<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewIgeGameController;
use App\Http\Controllers\AuthorisationController;



Route::match(['GET','POST'], '/component/weaver', [AuthorisationController::class, 'dispatch'])
    ->name('weaver.dispatch');

// (Optional: pretty routes if you want them too)
Route::post('/login', [AuthorisationController::class, 'playerLogin'])->name('weaver.login');
Route::post('/weaver/authorisation/reset-password', [AuthorisationController::class, 'resetPassword'])->name('weaver.reset');
Route::get('/weaver/authorisation/token', [AuthorisationController::class, 'getToken'])->name('weaver.token');
Route::get('/', [AuthorisationController::class, 'loginWindow'])->name('loginPage');
Route::get('/logout', [AuthorisationController::class, 'logout'])->name('logout');

Route::get('/games/newige', [NewIgeGameController::class, 'newIge']);
Route::get('/games/slot', [NewIgeGameController::class, 'slotGaming']);
Route::get('/register', [AuthorisationController::class, 'registerview'])->name('registerview');

Route::post('/check-availability', [AuthorisationController::class, 'checkAvailability'])->name('check.availability');
Route::post('/verify-otp', [AuthorisationController::class, 'verifyOtpRegistration'])->name('verify.otp');
Route::post('/player-registration', [AuthorisationController::class, 'playerRegistration'])->name('player.registration');
