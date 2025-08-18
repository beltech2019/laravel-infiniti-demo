<?php

namespace App\Helpers;

use Detection\MobileDetect;

class Configuration
{
    const DOMAIN_NAME = "ice.igamew.com";
    const TEST_DOMAIN_NAME = "ice.igamew.com";
    const CONTENT_SERVER_DOMAIN = "https://www-wls.infinitilotto.com/";
    const DOMAIN = "https://www-wls.infinitilotto.com";
    const RAM_MERCHANT_CODE = "INFINITI";
    const GAMES_DOMAIN = "https://games-wls.infinitilotto.com/";
    const SPORTS_BETTING_IFRAME = "https://sbs-wls-player.infinitilotto.com/";
    const WEB_SOCKET_DOMAIN = "wss://games-wls.infinitilotto.com/websocket";

    const IGE_PATH = [
        "IGEASIA" => "https://ige-wls.infinitilotto.com/InstantGameEngineASIA/",
        "IGEICE"  => "https://ige-wls.infinitilotto.com/InstantGameEngine/",
        "IGEBETA" => "https://ige-wls.infinitilotto.com/InstantGameEngineNode/",
        "IGEMS"   => "https://ige-wls.infinitilotto.com/InstantGameEngineMS/"
    ];

    const BOLD_CHAT_ACCOUNT_ID = "738474531418939854";
    const BOLD_CHAT_INVITATION_ID = "731482418849032442";
    const BOLD_CHAT_WEBSITE_DEF_ID = "1791682981619001421";
    const BOLD_CHAT_FLOAT_CHAT_ID = "731482418999369717";
    const BOLD_CHAT_CB_ID = "731482418505888867";

    const DEVICE_PC = "PC";
    const DEVICE_MOBILE = "MOBILE_WEB";
    const DEVICE_TABLET = "TAB";
    const DEVICE_DOWNLOADABLE_CLIENT = "DOWNLOADABLE_CLIENT";

    const GOOGLE_CALLBACK = self::DOMAIN . "/gmail-callback";
    const YAHOO_CALLBACK = self::DOMAIN . "/yho-callback";
    const OUTLOOK_CALLBACK = self::DOMAIN . "/outlook-callback";
    const FACEBOOK_CALLBACK = self::DOMAIN . "/facebook-callback";

    const LOGIN_DEVICE_PC_BROWSER = "PC_BROWSER";
    const LOGIN_DEVICE_PC_DOWNLOADABLE_CLIENT = "PC_DOWNLOADABLE_CLIENT";
    const LOGIN_DEVICE_ANDROID_BROWSER = "ANDROID_BROWSER";
    const LOGIN_DEVICE_ANDROID_APP = "ANDROID_APP";
    const LOGIN_DEVICE_IOS_BROWSER = "IOS_BROWSER";
    const LOGIN_DEVICE_IOS_APP = "IOS_APP";
    const LOGIN_DEVICE_WINDOWS_BROWSER = "WINDOWS_BROWSER";
    const LOGIN_DEVICE_WINDOWS_APP = "WINDOWS_APP";

    const OS_WINDOWS = "Windows";
    const OS_MAC = "Mac";
    const OS_LINUX = "Linux";
    const OS_IOS = "iOS";
    const OS_ANDROID = "Android";
    const OS_BLACKBERRY = "Blackberry";

    const CLIENT_FULL_WEB = "Full-Web";
    const CLIENT_DOWNLOADABLE = "Downloadable";
    const CLIENT_MOBILE_WEB = "Mobile-Web";
    const CLIENT_IOS_APP = "IOS-APP";
    const CLIENT_ANDROID_FULL = "Android-Full";
    const CLIENT_ANDROID_LITE = "Android-Lite";
    const CLIENT_WINDOWS_APP = "Windows App";
    const CLIENT_BLACKBERRY_APP = "BlackBerry App";

    const MINIMUM_BALANCE = 50;

    public static function setCurrencyDetails($currencyCode)
    {
        $data = Constants::$currencyMap[$currencyCode] ?? Constants::$currencyMap[Constants::DEFAULT_CURRENCY_CODE];
        session(['CurrencyDetails' => $data]);
    }

    public static function getCurrencyDetails()
    {
        return session('CurrencyDetails');
    }

    public static function getClientIP()
    {
        return request()->server('HTTP_X_REAL_IP') ??
               request()->server('HTTP_CLIENT_IP') ??
               request()->server('HTTP_X_FORWARDED_FOR') ??
               request()->server('HTTP_X_FORWARDED') ??
               request()->server('HTTP_FORWARDED_FOR') ??
               request()->server('HTTP_FORWARDED') ??
               request()->server('REMOTE_ADDR') ??
               'UNKNOWN';
    }

    public static function getDevice()
    {
        return request()->server('HTTP_USER_AGENT');
    }

    public static function getDeviceType()
    {
        $detect = new MobileDetect;
        return $detect->isMobile() ? self::DEVICE_MOBILE : self::DEVICE_PC;
    }

    public static function getOS()
    {
        return self::detectOS(self::getDevice());
    }

    public static function getOSVer()
    {
        return self::detectOSVersion(self::getDevice());
    }

    public static function getClientType($deviceType, $os)
    {
        $map = [
            self::DEVICE_PC => [
                self::OS_WINDOWS => self::CLIENT_FULL_WEB,
                self::OS_MAC     => self::CLIENT_DOWNLOADABLE,
                self::OS_LINUX   => self::CLIENT_MOBILE_WEB
            ],
            self::DEVICE_MOBILE => [
                self::OS_IOS       => self::CLIENT_IOS_APP,
                self::OS_ANDROID   => self::CLIENT_ANDROID_FULL,
                self::OS_LINUX     => self::CLIENT_BLACKBERRY_APP,
                self::OS_WINDOWS   => self::CLIENT_ANDROID_LITE,
                self::OS_BLACKBERRY=> self::CLIENT_WINDOWS_APP
            ],
            self::DEVICE_TABLET => [
                self::OS_IOS       => self::CLIENT_IOS_APP,
                self::OS_ANDROID   => self::CLIENT_ANDROID_FULL,
                self::OS_LINUX     => self::CLIENT_BLACKBERRY_APP,
                self::OS_WINDOWS   => self::CLIENT_ANDROID_LITE,
                self::OS_BLACKBERRY=> self::CLIENT_WINDOWS_APP
            ]
        ];

        return $map[$deviceType][$os] ?? '';
    }

    public static function getLoginDevice()
    {
        $os = self::getOS();
        $deviceType = self::getDeviceType();

        if ($deviceType == self::DEVICE_PC) {
            return self::LOGIN_DEVICE_PC_BROWSER;
        }

        if (in_array($deviceType, [self::DEVICE_TABLET, self::DEVICE_MOBILE])) {
            return match ($os) {
                self::OS_ANDROID => self::LOGIN_DEVICE_ANDROID_BROWSER,
                self::OS_IOS     => self::LOGIN_DEVICE_IOS_BROWSER,
                self::OS_WINDOWS => self::LOGIN_DEVICE_WINDOWS_BROWSER,
                default          => self::LOGIN_DEVICE_PC_BROWSER
            };
        }

        return self::LOGIN_DEVICE_PC_DOWNLOADABLE_CLIENT;
    }

    public static function getAppAndClientType($deviceType)
    {
        if ($deviceType == self::DEVICE_PC) {
            return ["APPTYPE" => "WEB", "CLIENTTYPE" => "FLASH"];
        }

        $os = self::getOS();
        return match (strtolower($os)) {
            strtolower(self::OS_IOS)     => ["APPTYPE" => "IOS_WEB", "CLIENTTYPE" => "IMAGE_GENERATION"],
            strtolower(self::OS_ANDROID) => ["APPTYPE" => "ANDROID_WEB", "CLIENTTYPE" => "IMAGE_GENERATION"],
            default                      => ["APPTYPE" => "OTHER_WEB", "CLIENTTYPE" => "IMAGE_GENERATION"]
        };
    }

    private static function detectOS($userAgent)
    {
        $oses = [
            'Windows'    => 'Windows',
            'Mac'        => 'Mac',
            'Linux'      => 'Linux',
            'iPhone'     => 'iOS',
            'iPad'       => 'iOS',
            'Android'    => 'Android',
            'BlackBerry' => 'Blackberry'
        ];

        foreach ($oses as $pattern => $value) {
            if (stripos($userAgent, $pattern) !== false) {
                return $value;
            }
        }
        return 'Unknown';
    }

    private static function detectOSVersion($userAgent)
    {
        preg_match('/[0-9\._]+/', $userAgent, $matches);
        return $matches[0] ?? '';
    }
}
