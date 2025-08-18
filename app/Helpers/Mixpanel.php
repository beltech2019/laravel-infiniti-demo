<?php
namespace App\Helpers;

use App\Helpers\Includes;

class Mixpanel {
    static $MIXPANEL_ID = "";
    const MIXPANEL_DOMAIN = Configuration::DOMAIN;
    public function __construct() {
        self::setMixPanelToken();
    }
    public static function setMixPanelToken() {
        self::$MIXPANEL_ID = Session::getSessionVariable('mixpanelToken');
    }
    public static function getMixPanelToken() {
        return self::$MIXPANEL_ID;
    }
    public static function fireLoginEvent() {
        Session::unsetSessionVariable('fireLoginEvent');
        $playerLoginInfo = Utilities::getPlayerLoginResponse();
        return;
        $document = JFactory::getDocument();
        $document->addScriptDeclaration("
            jQuery(document).ready(function($) {    
                mixpanelLogin('" . self::MIXPANEL_DOMAIN . "',
                    '" . (isset($playerLoginInfo->state) ? $playerLoginInfo->state : '') . "',
                    '" . (isset($playerLoginInfo->referSource) ? $playerLoginInfo->referSource : '') . "',
                    '" . (isset($playerLoginInfo->campaignName) ? $playerLoginInfo->campaignName : '') . "',
                    '" . (isset($playerLoginInfo->playerStatus) ? $playerLoginInfo->playerStatus : '') . "',
                    '" . (isset($playerLoginInfo->lastLoginIP) ? $playerLoginInfo->lastLoginIP : '') . "',
                    '" . (isset($playerLoginInfo->registrationIp) ? $playerLoginInfo->registrationIp : '') . "',
                    '" . (isset($playerLoginInfo->userName) ? $playerLoginInfo->userName : '') . "',
                    '" . (isset($playerLoginInfo->playerId) ? $playerLoginInfo->playerId : '') . "',
                    '" . (isset($playerLoginInfo->registrationDate) ? $playerLoginInfo->registrationDate : '') . "',
                    '" . (isset($playerLoginInfo->regDevice) ? $playerLoginInfo->regDevice : '') . "',
                    '" . (isset($playerLoginInfo->emailId) ? $playerLoginInfo->emailId : '') . "',
                    '" . (isset($playerLoginInfo->emailVerified) ? $playerLoginInfo->emailVerified : '') . "',
                    '" . (isset($playerLoginInfo->mobileNo) ? $playerLoginInfo->mobileNo : '') . "',
                    '" . (isset($playerLoginInfo->phoneVerified) ? $playerLoginInfo->phoneVerified : '') . "',
                    '" . (isset($playerLoginInfo->lastLoginDate) ? $playerLoginInfo->lastLoginDate : '') . "',
                    '" . (isset($playerLoginInfo->firstDepositDate) ? $playerLoginInfo->firstDepositDate : '') . "',
                    '" . (isset($playerLoginInfo->firstName) ? $playerLoginInfo->firstName : '') . "',
                    '" . (isset($playerLoginInfo->lastName) ? $playerLoginInfo->lastName : '') . "',
                    '" . (isset($playerLoginInfo->gender) ? $playerLoginInfo->gender : '') . "',
                    '" . (isset($playerLoginInfo->dob) ? $playerLoginInfo->dob : '') . "',
                    '" . (isset($playerLoginInfo->city) ? $playerLoginInfo->city : '') . "',
                    '" . (isset($playerLoginInfo->pinCode) ? $playerLoginInfo->pinCode : '') . "',
                    '" . (isset($playerLoginInfo->walletBean->cashBalance) ? $playerLoginInfo->walletBean->cashBalance : '') . "',
                    '" . (isset($playerLoginInfo->walletBean->practiceBalance) ? $playerLoginInfo->walletBean->practiceBalance : '') . "',
                    MIXPANEL_DEVICE_TYPE,
                    'Website',
                    'Web',
                    '" . (isset($playerLoginInfo->affiliateId) ? $playerLoginInfo->affiliateId : '') . "',
                    '" . Configuration::getOS() . "');
            });
        ");
    }

    public static function fireRegistrationEvent() {
        Session::unsetSessionVariable('fireRegistrationEvent');
        $playerLoginInfo = Utilities::getPlayerLoginResponse();
        return;
        $document = JFactory::getDocument();
        $document->addScriptDeclaration("
            jQuery(document).ready(function($) {
                mixpanelReg('" . self::MIXPANEL_DOMAIN . "',
                    '" . (isset($playerLoginInfo->referSource) ? $playerLoginInfo->referSource : '') . "',
                    '" . (isset($playerLoginInfo->registrationIp) ? $playerLoginInfo->registrationIp : '') . "',
                    '" . (isset($playerLoginInfo->userName) ? $playerLoginInfo->userName : '') . "',
                    '" . (isset($playerLoginInfo->playerId) ? $playerLoginInfo->playerId : '') . "',
                    '" . (isset($playerLoginInfo->registrationDate) ? $playerLoginInfo->registrationDate : '') . "',
                    '" . (isset($playerLoginInfo->regDevice) ? $playerLoginInfo->regDevice : '') . "',
                    '" . (isset($playerLoginInfo->emailId) ? $playerLoginInfo->emailId : '') . "',
                    '" . (isset($playerLoginInfo->mobileNo) ? $playerLoginInfo->mobileNo : '') . "',
                    '" . (isset($playerLoginInfo->walletBean->cashBalance) ? $playerLoginInfo->walletBean->cashBalance : '') . "',
                    '" . (isset($playerLoginInfo->campaignName) ? $playerLoginInfo->campaignName : '') . "',
                    MIXPANEL_DEVICE_TYPE,
                    'Website',
                    'Web',
                    '" . (isset($playerLoginInfo->affiliateId) ? $playerLoginInfo->affiliateId : '') . "',
                    '" . Configuration::getOS() . "');
            });
        ");
    }

}
