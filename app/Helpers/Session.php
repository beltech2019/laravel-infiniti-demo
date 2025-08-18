<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\Support\Facades\Auth;

class Session
{
    const USER_ID = 398;

    public static function sessionInitiate($response)
    {
        if (isset($response->mapping)) {
            $response->playerLoginInfo->mapping = $response->mapping;
        }
        if (isset($response->ipRegion)) {
            $response->playerLoginInfo->ipRegion = $response->ipRegion;
        }

        Utilities::setPlayerLoginResponse($response->playerLoginInfo ?? '');
        Utilities::setRamPlayerInfoResponse($response->ramPlayerInfo ?? '');
        Utilities::setPlayerToken($response->playerToken ?? '');
        Utilities::setPlayerId($response->playerLoginInfo->playerId ?? '');

        // In Laravel, we can store user info directly in the session
        LaravelSession::put('user', [
            'id'     => self::USER_ID,
            'guest'  => 0
        ]);

        LaravelSession::put('imgUploadDomain', $response->domainName ?? null);

        if (isset($response->mixPanenlToken)) {
            LaravelSession::put('mixpanelToken', $response->mixPanenlToken);
        }
        if (!empty($response->rummyDeepLink)) {
            LaravelSession::put('deepLink', $response->rummyDeepLink);
        }

        LaravelSession::put('popUpShownOn', []);
        LaravelSession::put('popUpShownId', []);

        $depositReferSourceData = [];
        foreach (['firstDepositReferSource', 'firstDepositReferSourceId', 'firstDepositSubSourceId', 'firstDepositCampTrackId'] as $field) {
            if (isset($response->$field)) {
                $depositReferSourceData[$field] = $response->$field;
            }
        }
        if (!empty($depositReferSourceData)) {
            LaravelSession::put('depositReferSourceData', $depositReferSourceData);
        }

        if (Constants::TEMP_AUTH_ENABLED) {
            LaravelSession::put('temporaryAuthentication', true);
        }
    }

    public static function sessionRemove()
    {
        LaravelSession::put('user', [
            'guest' => 1,
            'id'    => 0
        ]);

        $sessionVariables = [
            'user', 'playerLoginResponse', 'playerToken', 'playerId', 'cashier_initiate', 'select_amount',
            'before_payment', 'depositRequest', 'url', 'type', 'afterPaymentRedirect', 'afterPaymentMessage',
            'promoCode', 'depositAmount', 'tierName', 'pokertournametFeedlist', 'tournamentPrize', 'imgUploadDomain',
            'popUpShownOn', 'popUpShownId', 'temporaryAuthentication', 'REG_WIDGET_COUNT', 'LOGIN_WIDGET_COUNT',
            'FP_WIDGET_COUNT', 'fromPage', 'logout_playerInfo', 'fromLogOut', 'passwordChanged',
            'verificationPending', 'verificationPendingUserName', 'fireLoginEvent', 'passwordReset',
            'forgot_emailid', 'refer_a_friend', 'refer_a_friend_gmail', 'refer_a_friend_yahoo',
            'refer_a_friend_outlook', 'fireRegistrationEvent', 'after_registration', 'withdrawalAmount',
            'withdrawalDate', 'withdrawalTime', 'payTypeName', 'subTypeName', 'reEncString1', 'mixpanelToken',
            'activation-link-expired', 'account_activated', 'forgot-password-link-expired',
            'verificationCodeResetPassword', 'loyaltyTierName', 'loyaltyTotalPoints', 'loyaltyBarPercentage',
            'bonusBarPercentage', 'bonusBarReceived', 'bonusBarRedeemed', 'loyalPlayerDetail',
            'loyaltyCurrentTierEarning', 'isDepositProcessable', 'isDepositProcessableMsg',
            'dontShowDefaultError', 'loyaltyWithdrawalLimitExhausted', 'loyaltyWithdrawalLimitExceeded',
            'loyaltyCurrentTierMaintanancePoints', 'showBackButton', 'isDepositProcessableThird'
        ];

        foreach ($sessionVariables as $var) {
            LaravelSession::forget($var);
        }
    }

    public static function sessionValidate()
    {
        if (
            LaravelSession::has('playerLoginResponse') &&
            LaravelSession::has('playerToken') &&
            LaravelSession::has('user') &&
            (LaravelSession::get('user')['id'] ?? null) == self::USER_ID
        ) {
            return true;
        }

        LaravelSession::put('user', [
            'guest' => 1,
            'id'    => 0
        ]);

        return false;
    }

    public static function setSessionVariable($name = '', $value = '')
    {
        LaravelSession::put($name, $value);
    }

    public static function getSessionVariable($name)
    {
        return LaravelSession::has($name) ? LaravelSession::get($name) : false;
    }

    public static function unsetSessionVariable($name)
    {
        LaravelSession::forget($name);
    }
}
