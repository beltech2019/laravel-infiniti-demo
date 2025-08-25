<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

function authUserId(){
    $userId = session('user_id');
    return $userId;
}

function authUserBalance(){
    $userId = session('user_id');
    Log::info($userId);
    $userSession = $userId ? Cache::get('user_session_' . $userId) : null;
    $balance = $userSession->playerLoginInfo->walletBean->totalBalance ?? 0;
    return number_format($balance);
}

function authUserName(){
    $userId = session('user_id');
    $userSession = $userId ? Cache::get('user_session_' . $userId) : null;
    $userName = $userSession->playerLoginInfo->userName ?? '';
    Log::info($userName);
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
        
        