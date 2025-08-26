<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Helpers\Utilities;
use app\Helpers\Configuration;
use app\Helpers\Constants;
use app\Helpers\Session;
use Log;

class NewIgeGameController extends Controller
{
    public function newIge(Request $request)
    {
        $vendor = htmlspecialchars($request->get('vendor', ''), ENT_QUOTES, 'UTF-8');
        $game = (int) $request->get('game', 0);
        $playType = htmlspecialchars($request->get('playType', ''), ENT_QUOTES, 'UTF-8');
        $return_url = htmlspecialchars(url()->current(), ENT_QUOTES, 'UTF-8');
        $lang = substr(app()->getLocale(), 0, 2); // e.g., 'en'

        // Replace these with your own logic
        $playerToken = Utilities::getPlayerToken();
        $playerInfo = Utilities::getPlayerLoginResponse();
        $currencyInfo = Utilities::getCurrencyInfo();

        $url = htmlspecialchars(Configuration::GAMES_DOMAIN, ENT_QUOTES, 'UTF-8');

        $totalBalance = (is_object($playerInfo) && isset($playerInfo->walletBean))
            ? (float) ($playerInfo->walletBean->totalBalance ?? 0)
            : 0.0;

        $playerId = htmlspecialchars($playerInfo->playerId ?? '', ENT_QUOTES, 'UTF-8');
        $userName = htmlspecialchars($playerInfo->userName ?? '', ENT_QUOTES, 'UTF-8');
        $domain = htmlspecialchars(Configuration::DOMAIN_NAME, ENT_QUOTES, 'UTF-8');
        $currency = htmlspecialchars($currencyInfo[0], ENT_QUOTES, 'UTF-8');
        $dispCurrency = htmlspecialchars($currencyInfo[1], ENT_QUOTES, 'UTF-8');

        return view('games.newige', compact(
            'vendor',
            'game',
            'playType',
            'return_url',
            'lang',
            'playerToken',
            'totalBalance',
            'playerId',
            'userName',
            'domain',
            'currency',
            'dispCurrency',
            'url'
        ));
    }


    public function slotGaming(Request $request)
    {
        $slotList = Utilities::getCTGamelist();

        $token = '';
        $playerId = '';
        $currency = '';

        if (Session::sessionValidate()) {
            $playerLoginResponse = Utilities::getPlayerLoginResponse();
            $token = Utilities::getPlayerToken() ?? '';
            $playerId = $playerLoginResponse->walletBean->playerId ?? '';
            $currency = $playerLoginResponse->walletBean->currency ?? '';
        }

        return view('games.slotgaming', compact('slotList', 'token', 'playerId', 'currency'));
    }

    public function crazyBillions(Request $request)
    {
        $gamelist = Utilities::crazyBillionGames();

        $token = '';
        $playerId = '';
        $currency = '';
        $playerLoginResponse = '';

        if (Session::sessionValidate()) {
            $playerLoginResponse = Utilities::getPlayerLoginResponse();
            $token = Utilities::getPlayerToken() ?? '';
            $playerId = $playerLoginResponse->walletBean->playerId ?? '';
            $currency = $playerLoginResponse->walletBean->currency ?? '';
        }
        return view('games.crazybillions', compact('gamelist', 'token', 'playerId', 'currency'));
    }


    public function gameart(Request $request)
    {
        $artlist = Utilities::getArtGameList();

        $token = '';
        $playerId = '';
        $currency = '';
        $playerLoginResponse = '';

        if (Session::sessionValidate()) {
            $playerLoginResponse = Utilities::getPlayerLoginResponse();
            $token = Utilities::getPlayerToken() ?? '';
            $playerId = $playerLoginResponse->playerId ?? '';
            $currency = $playerLoginResponse->walletBean->currency ?? '';
        }
        return view('games.gameart', compact('artlist', 'token', 'playerId', 'currency'));
    }

    public function sportsbetting(Request $request)
    {
        $lang = 'en';
        $playerToken = Utilities::getPlayerToken();
        $playerId = Utilities::getPlayerID();
        $url = Configuration::SPORTS_BETTING_IFRAME;
        $currencyInfo = Utilities::getCurrencyInfo();
        $currency = $currencyInfo[0];
        $dispCurrency = $currencyInfo[1];
        if(empty($dispCurrency))
        $dispCurrency = Constants::DEFAULT_CURRENCY_CODE;
        $domain_main = Configuration::DOMAIN_NAME; 
        return view('games.sportsbetting', compact('domain_main', 'lang', 'playerToken', 'playerId', 'url' , 'currencyInfo' , 'currency' , 'dispCurrency'));
    }

    public function bingo(Request $request)
    {
        $lang = 'en';
        $playerToken = Utilities::getPlayerToken();
        $playerId = Utilities::getPlayerID();
        $url = Configuration::GAMES_DOMAIN;
        $currencyInfo = Utilities::getCurrencyInfo();
        $currency = $currencyInfo[0];
        $dispCurrency = $currencyInfo[1];
        $playerInfo = Utilities::getPlayerLoginResponse();
        $totalBalance = (is_object($playerInfo) && isset($playerInfo->walletBean)) ? (float) ($playerInfo->walletBean->totalBalance ?? 0) : 0.0;
        $domain_main = Configuration::DOMAIN_NAME; 
        return view('games.bingo', compact('playerInfo', 'totalBalance', 'domain_main', 'lang', 'playerToken', 'playerId', 'url' , 'currencyInfo' , 'currency' , 'dispCurrency'));
    }
  

    public function lottery(Request $request)
    {
        $lang = 'en';
        $playerToken = Utilities::getPlayerToken();
        $playerId = Utilities::getPlayerID();
        $url = Configuration::GAMES_DOMAIN;
        $currencyInfo = Utilities::getCurrencyInfo();
        $currency = $currencyInfo[0];
        $dispCurrency = $currencyInfo[1];
        $playerInfo = Utilities::getPlayerLoginResponse();
        $totalBalance = (is_object($playerInfo) && isset($playerInfo->walletBean)) ? (float) ($playerInfo->walletBean->totalBalance ?? 0) : 0.0;
        $domain_main = Configuration::DOMAIN_NAME; 
        $userName = $playerInfo->userName ?? '';
        return view('games.lottery', compact('userName', 'playerInfo', 'totalBalance', 'domain_main', 'lang', 'playerToken', 'playerId', 'url' , 'currencyInfo' , 'currency' , 'dispCurrency'));
    }

    public function sportsPool(Request $request)
    {
        $lang = 'en';
        $playerToken = Utilities::getPlayerToken();
        $playerId = Utilities::getPlayerID();
        $url = 'https://dm-node1-wls.infinitilotto.com/';
        $currencyInfo = Utilities::getCurrencyInfo();
        $currency = $currencyInfo[0];
        $dispCurrency = $currencyInfo[1];
        $playerInfo = Utilities::getPlayerLoginResponse();
        $totalBalance = (is_object($playerInfo) && isset($playerInfo->walletBean)) ? (float) ($playerInfo->walletBean->totalBalance ?? 0) : 0.0;
        $domain_main = Configuration::DOMAIN_NAME; 
        return view('games.sportsPool', compact('playerInfo', 'totalBalance', 'domain_main', 'lang', 'playerToken', 'playerId', 'url' , 'currencyInfo' , 'currency' , 'dispCurrency'));
    }
}
