<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewIgeGameController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthorisationController;



Route::match(['GET','POST'], '/component/weaver', [AuthorisationController::class, 'dispatch'])
    ->name('weaver.dispatch');

// (Optional: pretty routes if you want them too)
Route::post('/login', [AuthorisationController::class, 'playerLogin'])->name('weaver.login');
Route::post('/weaver/authorisation/reset-password', [AuthorisationController::class, 'resetPassword'])->name('weaver.reset');
Route::get('/weaver/authorisation/token', [AuthorisationController::class, 'getToken'])->name('weaver.token');
Route::get('/', [AuthorisationController::class, 'loginWindow'])->name('loginPage');
Route::get('/logout', [AuthorisationController::class, 'logout'])->name('logout');

Route::get('/register', [AuthorisationController::class, 'registerview'])->name('registerview');
Route::post('/check-availability', [AuthorisationController::class, 'checkAvailability'])->name('check.availability');
Route::post('/registration-OTP', [AuthorisationController::class, 'registrationOTP'])->name('registration.OTP');
Route::post('/verify-otp', [AuthorisationController::class, 'verifyOtpRegistration'])->name('verify.otp');
Route::post('/player-registration', [AuthorisationController::class, 'playerRegistration'])->name('player.registration');

Route::post('/forget-password', [AuthorisationController::class, 'forgotPassword'])->name('forget.password');
Route::post('/reset-password-forgot', [AuthorisationController::class, 'resetPasswordForgot'])->name('resetPassword.Forgot');


Route::prefix('games')->name('games.')->group(function () {
    Route::get('/newige', [NewIgeGameController::class, 'newIge'])->name('instantgames');
    Route::get('/slot', [NewIgeGameController::class, 'slotGaming'])->name('slotgames');
    Route::get('/crazyBillions', [NewIgeGameController::class, 'crazyBillions'])->name('crazyBillions');
    Route::get('/gameart', [NewIgeGameController::class, 'gameart'])->name('gameart');
});

Route::prefix('account')->name('account.')->group(function () {
    Route::any('/getPlayerBalance', [AccountController::class, 'getPlayerBalance'])->name('getPlayerBalance');
    Route::get('/profile', function () {return view('account.profile');})->name('profile');
});