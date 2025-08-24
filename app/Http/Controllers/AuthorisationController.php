<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\Redirection;
use App\Helpers\Validations;
use App\Helpers\Errors;
use App\Helpers\Configuration;
use App\Helpers\ServerCommunication;
use App\Helpers\ServerUrl;
use App\Helpers\Utilities;
use App\Helpers\Constants;
use App\Helpers\Session as LegacySession;
use Illuminate\Support\Facades\Cache;


class AuthorisationController extends Controller
{
    public function playerLogin(Request $request)
    {
        $isAjax = $request->string('isAjax', '');
        Validations::$isAjax = ($isAjax === 'true');

        $userName    = $request->string('userName_email', '');
        $rawPassword    = $request->input('password', '');
        $loginToken  = $request->string('loginToken', '');
        $submitUrl   = $request->string('submiturl', null);
        $encPwd   = md5($rawPassword); 
        $hashedPw = md5($encPwd . $loginToken); 
        $password = $hashedPw;
        $requestData = [
            'userName'  => (string) $userName,
            'password'  => $password,
            'loginToken'=> (string) $loginToken,
            'requestIp' => Configuration::getClientIP(),
        ];

        $trackingCipher = LegacySession::getSessionVariable('reEncString');
        $requestData['trackingCipher'] = $trackingCipher !== false ? $trackingCipher : '';

        $response = ServerCommunication::sendCall(ServerUrl::PLAYER_LOGIN, $requestData, Validations::$isAjax);

        if (isset($response->errorCode) && $response->errorCode == 0 && isset($response->playerLoginInfo)) {
            $userId = $response->playerLoginInfo->playerId;
            Cache::put('user_session_' . $userId, $response, 60 * 24);
            session(['user_id' => $userId]);
            Utilities::setPlayerLoginResponse($response);
            Utilities::setPlayerToken($response->playerToken);
            LegacySession::sessionInitiate($response);
        }

        return response()->json([
            'error'       => '',
            'callBackURL' => $submitUrl,
            'response'    => $response
        ]);
    }

    public function resetPassword(Request $request)
    {
        $isAjax = $request->string('isAjax', '');
        Validations::$isAjax = ($isAjax === 'true');

        $newPassword     = $request->string('newPassword', '');
        $confirmPassword = $request->string('retypePassword', '');

        if ($newPassword === '' || $confirmPassword === '') {
            return Redirection::ajaxSendDataToView(true, 1, 'Invalid request.');
        }

        $verificationCode = LegacySession::getSessionVariable('verificationCodeResetPassword');
        if (!$verificationCode) {
            $response = (object)[
                'errorCode' => 0,
                'path'      => Redirection::EXPIRED_FORGOT_PASSWORD_LINK,
            ];
            LegacySession::setSessionVariable('forgot-password-link-expired', true);
            return Redirection::ajaxSendDataToView($response); // mirrors Joomla. 
        }

        $response = ServerCommunication::sendCall(ServerUrl::RESET_PASSWORD, [
            'verificationCode' => $verificationCode,
            'newPassword'      => (string) $newPassword,
            'confirmPassword'  => (string) $confirmPassword,
        ], Validations::$isAjax); // 

        if (Validations::getErrorCode() != 0) {
            return Redirection::ajaxSendDataToView(true, 1, Validations::getRespMsg());
        }

        $response->path = Redirection::PASSWORD_RESET;
        LegacySession::unsetSessionVariable('verificationCodeResetPassword');
        LegacySession::setSessionVariable('passwordReset', true);
        return Redirection::ajaxSendDataToView($response);
    }

    public function getToken(Request $request)
    {
        $title = $request->string('title', '');
        $token = Utilities::getPlayerToken(); // same behavior. 

        $response = [
            'title'              => (string) $title,
            'downloadClient'     => false,
            'openPlayerAliasModal'=> false,
        ];

        if ($token === false) {
            $response['errorCode'] = 101;
            return Redirection::ajaxSendDataToView($response);
        }

        $token = $token . "-" . Utilities::getPlayerId(); // same concatenation. 

        $response['errorCode']  = 0;
        $response['token']      = $token;
        $response['cashierLink']= Redirection::CASHIER_INITIATE;
        $response['rummyLink']  = ($title == 'play_new_rummy') ? Redirection::PLAY_HTML_RUMMY : Redirection::PLAY_RUMMY;

        // Alias logic mirrored. 
        $loginResp = Utilities::getPlayerLoginResponse();
        if (strtoupper(substr($loginResp->userName, 0, 4)) != 'STPL') {
            Utilities::updatePlayerLoginResponse(['pokerNickName' => 'ABC']);
        }

        if (trim((string)$loginResp->pokerNickName) === '') {
            $auto = Utilities::createPlayerAlias($loginResp->userName, 'CreateAlias', $loginResp->userName);
            if ($auto->errorCode != 0) {
                $response['openPlayerAliasModal'] = true;
                if (!LegacySession::getSessionVariable('aliasPageEnable')) {
                    LegacySession::setSessionVariable('aliasPageEnable', true);
                }
            }
        }

        return Redirection::ajaxSendDataToView($response);
    }

    public function loginWindow(Request $request)
    {
        return response()->view('weaver.login-window');
    }

    public function logout(Request $request)
    {
        $userId = session('user_id');
        if ($userId) {
            Cache::forget('user_session_' . $userId);
            session()->forget('user_id');
        }
        LegacySession::sessionRemove();
        return redirect()->route('loginPage');
    }

    public function registerview(Request $request)
    {
        $countries = Utilities::getCountryList();
        $currency = Constants::$currencyMap;
        $otp_enable = false;
        return response()->view('weaver.register',compact('countries', 'currency', 'otp_enable'));
    }

    public function checkAvailability(Request $request)
    {
        if (!LegacySession::sessionValidate()) {
            $registrationType = $request->input('registrationType', '');
            $password         = $request->input('reg_password', '');
            $mobileNo         = $request->input('mobile', 0);
            $stateCode        = $request->input('state', '');
            $submitUrl        = $request->input('submiturl', null);
            $refercode        = $request->input('refercode', '');

            $referSource = $refercode == '' ? '' : 'REFER_FRIEND';

            $currency   = Configuration::getCurrencyDetails();
            $currencyId = $request->input('currency');
            $countryCode= $request->input('countrycode');

            $requestArrRegistration = [
                "password"        => $password,
                "mobileNo"        => $mobileNo,
                "requestIp"       => Configuration::getClientIP(),
                "registrationType"=> $registrationType,
                "currencyId"      => $currencyId,
                "countryCode"     => $countryCode,
                "referCode"       => $refercode,
                "referSource"     => $referSource
            ];

            if ($registrationType == "FULL") {
                $requestArrRegistration['firstName'] = $request->input('fname', '');
                $requestArrRegistration['lastName']  = $request->input('lname', '');
            }

            LegacySession::setSessionVariable('playerPreRegistrationData', $requestArrRegistration);

            // check availability
            $requestArr = [
                "userName"   => $mobileNo,
                "domainName" => Configuration::DOMAIN_NAME
            ];

            $response = ServerCommunication::sendCall(ServerUrl::CHECK_AVAILABILITY, $requestArr, Validations::$isAjax);
            return response()->json($response);
        }
    }

    
    public function registrationOTP(Request $request) //done
    {
        $isAjax = $request->input('isAjax', '');
        Validations::$isAjax = ($isAjax == 'true') ? true : false;
        $mobileNo = LegacySession::getSessionVariable('playerPreRegistrationData')['mobileNo'];
        $regOtpRequestArr = array(
            "mobileNo" => $mobileNo,
            "aliasName" => Configuration::DOMAIN_NAME
        );

        $response = ServerCommunication::sendCallRam(ServerUrl::RAM_PRELOGIN_SEND_OTP, $regOtpRequestArr, Validations::$isAjax,true, false, 'GET');
        return response()->json($response);
    }


    public function verifyOtpRegistration(Request $request)
    {
        $isAjax = $request->input('isAjax', '');
        Validations::$isAjax = ($isAjax === 'true');
        $verificationCode = $request->input('otp_confirm', '');
        $preData = LegacySession::getSessionVariable('playerPreRegistrationData'); 
        $requestArr = [
            "countryCode"     => $preData['countryCode'],
            "password"        => $preData['password'],
            "mobileNo"        => $preData['mobileNo'],
            "requestIp"       => Configuration::getClientIP(),
            "registrationType"=> 'REGISTRATION',
            "currencyCode"    => $preData['currencyId'],
            "otp"             => $verificationCode,
        ];

        if (!empty($preData['referCode'])) {
            $requestArr["referCode"]   = $preData["referCode"];
            $requestArr["referSource"] = $preData["referSource"];
        }

        if (!empty($preData['trackId'])) {
            $requestArr["trackId"] = $preData["trackId"];
        }

        if (!empty($preData['campId'])) {
            $requestArr["campId"] = $preData["campId"];
        }

        if ($preData['registrationType'] == "FULL") {
            $requestArr['firstName'] = $preData['fname'] ?? '';
            $requestArr['lastName']  = $preData['lname'] ?? '';
        }

        $response = ServerCommunication::sendCallRam(ServerUrl::RAM_REGISTRATION, $requestArr, Validations::$isAjax);
        return response()->json($response);
        // LegacySession::sessionInitiate($response);
        // LegacySession::unsetSessionVariable("playerPreRegistrationData");
        // $redirectTo = Redirection::LOGIN;
    }

    public function playerRegistration(Request $request)
    {
        if (!LegacySession::sessionValidate()) {
            $userName   = $request->input('userName', '');
            $mobileNo   = $request->input('mobile', 0);
            $emailId    = $request->input('email', '');
            $password   = $request->input('reg_password', '');
            $registrationType = $request->input('registrationType', '');
            $currency   = $request->input('currency', '');
            $countrycode= (int)str_replace('-', '', $request->input('countrycode', 0));
            $country    = $request->input('country', '');

            $mobileNo   = $countrycode . $mobileNo;

            $requestArr = [
                "userName"        => $userName,
                "password"        => $password,
                "mobileNo"        => $mobileNo,
                "emailId"         => $emailId,
                "requestIp"       => Configuration::getClientIP(),
                "registrationType"=> $registrationType,
                "countryCode"     => $country,
                "currencyCode"    => $currency,
                "eventTypes"      => ["ALL"],
                "type"            => 'EMAIL'
            ];

            $preData = LegacySession::getSessionVariable('playerPreRegistrationData');

            if (!empty($preData['referCode'])) {
                $requestArr["referCode"] = $preData["referCode"];
            }
            if (!empty($preData['trackId'])) {
                $requestArr["trackId"] = $preData["trackId"];
            }
            if (!empty($preData['campId'])) {
                $requestArr["campId"] = $preData["campId"];
            }

            if ($registrationType == "FULL") {
                $requestArr['firstName'] = $preData['fname'] ?? '';
                $requestArr['lastName']  = $preData['lname'] ?? '';
            }

            $response = ServerCommunication::sendCallRam(ServerUrl::RAM_REGISTRATION, $requestArr, Validations::$isAjax);
            echo json_encode($response);
            exit; 
            if ($response->errorCode != 0) {
                if (Validations::$isAjax) {
                    return Redirection::ajaxSendDataToView($response);
                }
                return Redirection::to(Redirection::LOGIN, Errors::TYPE_ERROR, Validations::getRespMsg());
            }
       
            LegacySession::sessionInitiate($response);
            LegacySession::unsetSessionVariable("playerPreRegistrationData");

            $redirectTo = Redirection::LOGIN;

            if (Validations::$isAjax) {
                $response->path = $redirectTo;
                return Redirection::ajaxSendDataToView($response);
            }
        } else {
            if (Validations::$isAjax) {
                return Redirection::ajaxExit(Redirection::LOGIN, Constants::AJAX_FLAG_SESSION_EXPIRE, Errors::TYPE_ERROR, Errors::SESSION_EXPIRED);
            }
            return Redirection::to(Redirection::LOGIN, Errors::TYPE_ERROR, Errors::SESSION_EXPIRED);
        }
    }

    function forgotPassword(Request $request) {
        $mobile = $request->input('forget_mobile', '');
        $isAjax = $request->input('isAjax', '');
        Validations::$isAjax = ($isAjax == 'true') ? true : false;
        $response = ServerCommunication::sendCall(ServerUrl::FORGOT_PASSWORD, array(
                    "mobileNo" => $mobile
                        ), Validations::$isAjax);
                        
        $response->mobile = $mobile;
        return response()->json($response);
    }



    function resetPasswordForgot(Request $request) {
        $isAjax = $request->input('isAjax', '');
        Validations::$isAjax = ($isAjax == 'true') ? true : false;
        $newPassword = $request->input('newPassword', '');
        $confirmPassword = $request->input('retypePassword', '');
        $verificationCode = $request->input('playerotp', '');
        $mobile = $request->input('forgot_mobile', '');
        $response = ServerCommunication::sendCall(ServerUrl::RESET_PASSWORD, array(
            "otp" => $verificationCode,
            "newPassword" => $newPassword,
            "confirmPassword" => $confirmPassword,
            "mobileNo" => $mobile
        ), Validations::$isAjax);
        return response()->json($response);
    }

}
