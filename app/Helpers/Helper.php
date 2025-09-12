<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Helpers\Session as LegacySession;
use App\Helpers\Utilities;
use Carbon\Carbon;
use App\Models\LinksContent;
use App\Models\Language;
use App\Models\FAQ;
use App\Models\Banners;
use App\Models\Articles;
use App\Models\Games;
function authUserId(){
    $userId = session('user_id');
    return $userId;
}

function sessionLogin(){
    if (LegacySession::sessionValidate()) {
        return true;
    }else{
        return false;
    }
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

function authUserCountry(){
    $userId = session('user_id');
    $userSession = $userId ? Cache::get('user_session_' . $userId) : null;
    $userName = $userSession->playerLoginInfo->country ?? '';
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
        
function normalize_path($path) {
    return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
}
       
function formatDateTime($dateTime)
{
    if (empty($dateTime)) {
        return null;
    }

    try {
        return Carbon::parse($dateTime)->format('M d, Y H:i:s');
    } catch (Exception $e) {
        return null; // or return original string on parse failure
    }
}

function getCurrencyDetailcode(){
    $playerInfo = Utilities::getPlayerLoginResponse();
    $currency = $playerInfo->walletBean->currency;
    return $currency;
}

function getFaqs()
{
    $lang = substr(app()->getLocale(), 0, 2);
    return FAQ::where('lang',$lang)->get();
}

function responsibleGamingdata()
{
    $lang = substr(app()->getLocale(), 0, 2);
    return LinksContent::where('lang',$lang)->where('key','RESPONSIBLE_GAMING')->value('data');
}

function privacyPolicydata()
{
    $lang = substr(app()->getLocale(), 0, 2);
    return LinksContent::where('lang',$lang)->where('key','PRIVACY_POLICY')->value('data');
}

function termsandconditiondata()
{
    $lang = substr(app()->getLocale(), 0, 2);
    return LinksContent::where('lang',$lang)->where('key','TERMS_CONDITIONS')->value('data');
}

function responsibleGamingConfigdata($lang)
{
    return LinksContent::where('lang',$lang)->where('key','RESPONSIBLE_GAMING')->first();
}

function privacyPolicyConfigdata($lang)
{
    return LinksContent::where('lang',$lang)->where('key','PRIVACY_POLICY')->first();
}

function termsandconditionConfigdata($lang)
{
    return LinksContent::where('lang',$lang)->where('key','TERMS_CONDITIONS')->first();
}

function getAlllangs()
{
    return Language::all();
}


function getBannerPath(string $nameOrLocation, string $type = 'name'): ?string
    {
        $banner = null;

        if ($type === 'name') {
            $banner = Banners::where('name', $nameOrLocation)->first();
        } elseif ($type === 'location') {
            $banner = Banners::where('location', $nameOrLocation)->first();
        }

        return $banner ? asset($banner->path) : null;
    }



function articlesview($articlename)
{
    $articles =Articles::where('name', $articlename)->where('publish', 1)->first();
    
    return $articles ? true : false;
}

function gamesview($gamesname)
{
    $games =Games::where('name', $gamesname)->where('publish', 1)->first();
    if($games){
        return true;
    }else{
        return false;
    }
    
}