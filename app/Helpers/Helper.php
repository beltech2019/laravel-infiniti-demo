<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Helpers\Utilities;

function authUserId(){
    $userId = session('user_id');
    return $userId;
}

function authUserBalance(){
    $userId = session('user_id');
    $userSession = Utilities::getPlayerLoginResponse();
    $balance = $userSession->walletBean->totalBalance ?? 0;
    $currencyDisplayCode = $userSession->walletBean->currencyDisplayCode ?? '';
    return $currencyDisplayCode.' '.$balance;
}

function authUserName(){
    $userId = session('user_id');
    $userSession = $userId ? Cache::get('user_session_' . $userId) : null;
    $userName = $userSession->playerLoginInfo->userName ?? '';
    return $userName;
}

function callBackURL(){
     $callBackURL = urlencode("http://ala-new.winweaver.com/InstantGameEngineOLD/");
}

function playerToken(){
    $userId = session('user_id');
    $userSession = $userId ? Cache::get('user_session_' . $userId) : null;
    $token = $userSession->playerToken ?? 0;
    return $token;
}
        
        