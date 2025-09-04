<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewIgeGameController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthorisationController;
use App\Http\Controllers\ReferAFriendController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Log;



Route::middleware([SetLocale::class])->group(function () {
Route::match(['GET','POST'], '/component/weaver', [AuthorisationController::class, 'dispatch'])
    ->name('weaver.dispatch');

// (Optional: pretty routes if you want them too)
Route::post('/login', [AuthorisationController::class, 'playerLogin'])->name('weaver.login');
Route::post('/weaver/authorisation/reset-password', [AuthorisationController::class, 'resetPassword'])->name('weaver.reset');
Route::get('/weaver/authorisation/token', [AuthorisationController::class, 'getToken'])->name('weaver.token');
Route::get('/sessionLogincheck', [AuthorisationController::class, 'sessionLogincheck'])->name('sessionLogincheck');
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
    Route::get('/sportsbetting', [NewIgeGameController::class, 'sportsbetting'])->name('sportsbetting');
    Route::get('/bingo', [NewIgeGameController::class, 'bingo'])->name('bingo');
    Route::get('/lottery', [NewIgeGameController::class, 'lottery'])->name('lottery');
    Route::get('/sportsPool', [NewIgeGameController::class, 'sportsPool'])->name('sportsPool');
    Route::any('/gamelaunchUrl', [NewIgeGameController::class, 'gamelaunchUrl'])->name('gamelaunchUrl');
});

Route::prefix('account')->name('account.')->group(function () {
    Route::any('/getPlayerBalance', [AccountController::class, 'getPlayerBalance'])->name('getPlayerBalance');
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::any('/ticketsdetails', [AccountController::class, 'ticketsdetails'])->name('ticketsdetails');
    Route::post('/uploadPlayerAvatar', [AccountController::class, 'uploadPlayerAvatar'])->name('uploadPlayerAvatar');
    Route::post('/getTransactionDetails', [AccountController::class, 'getTransactionDetails'])->name('getTransactionDetails');
    Route::post('/getTransactionDetailsForTicket', [AccountController::class, 'getTransactionDetailsForTicket'])->name('getTransactionDetailsForTicket');
    Route::post('/getBonusDetails', [AccountController::class, 'getBonusDetails'])->name('getBonusDetails');
    Route::post('/playerInbox', [AccountController::class, 'playerInbox'])->name('playerInbox');
    Route::post('/inboxActivity', [AccountController::class, 'inboxActivity'])->name('inboxActivity');
    Route::post('/changePassword', [AccountController::class, 'changePassword'])->name('changePassword');
    Route::post('/updatePlayerProfile', [AccountController::class, 'updatePlayerProfile'])->name('updatePlayerProfile');
    Route::any('/cancelPendingWithdrawal', [AccountController::class, 'cancelPendingWithdrawal'])->name('cancelPendingWithdrawal');
    Route::any('/requestWithdrawalDetails', [AccountController::class, 'requestWithdrawalDetails'])->name('requestWithdrawalDetails');
    Route::any('/requestCashierDeposit', [AccountController::class, 'requestCashierDeposit'])->name('requestCashierDeposit');
});

Route::prefix('refer')->name('refer.')->group(function () {
    Route::post('/invite-friend', [ReferAFriendController::class, 'inviteFriend'])->name('inviteFriend');
    Route::post('/gmail-refer', [ReferAFriendController::class, 'gmailRefer'])->name('gmailRefer');
    Route::post('/facebook-refer', [ReferAFriendController::class, 'facebookRefer'])->name('facebookRefer');
    Route::post('/twitter-refer', [ReferAFriendController::class, 'twitterRefer'])->name('twitterRefer');
    Route::post('/send-reminder', [ReferAFriendController::class, 'sendReminder'])->name('sendReminder');
    Route::post('/track-bonus', [ReferAFriendController::class, 'trackBonus'])->name('trackBonus');
});


Route::get('lang/{locale}', function ($locale) {
    Log::info($locale);
    if (in_array($locale, ['en', 'fr', 'th', 'es'])) {
        Log::info(strtoupper(app()->getLocale()));
        session(['locale' => $locale]);
        Log::info(strtoupper(app()->getLocale()));
    }
    return redirect()->back();
})->name('lang.switch');

});
