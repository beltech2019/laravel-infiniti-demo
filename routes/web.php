<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewIgeGameController;
use App\Http\Controllers\AuthorisationController;



Route::match(['GET','POST'], '/component/weaver', [AuthorisationController::class, 'dispatch'])
    ->name('weaver.dispatch');

// (Optional: pretty routes if you want them too)
Route::post('/weaver/authorisation/login', [AuthorisationController::class, 'playerLogin'])->name('weaver.login');
Route::post('/weaver/authorisation/reset-password', [AuthorisationController::class, 'resetPassword'])->name('weaver.reset');
Route::get('/weaver/authorisation/token', [AuthorisationController::class, 'getToken'])->name('weaver.token');
Route::get('/weaver/authorisation/login-window', [AuthorisationController::class, 'loginWindow'])->name('weaver.loginWindow');


Route::get('/', function () {
    return view('welcome');
});
Route::get('/games/newige', [NewIgeGameController::class, 'newIge']);
Route::get('/games/slot', [NewIgeGameController::class, 'slotGaming']);
