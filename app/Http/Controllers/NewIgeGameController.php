<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Helpers\Utilities;
use app\Helpers\Configuration;
use app\Helpers\Session;
use Log;

class NewIgeGameController extends Controller
{
    public function newIge(Request $request)
    {
        // Fetch parameters from URL
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


    public function slotGaming()
    {
        // Example: Fetch from database, API, or mock data
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

    public function crazyBillions()
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
        log::info($playerLoginResponse);
        log::info($token);
        log::info($playerId);
        log::info($currency);
        return view('games.crazybillions', compact('gamelist', 'token', 'playerId', 'currency'));
    }

}
