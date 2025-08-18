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


class AuthorisationController extends Controller
{
    /**
     * Compatibility dispatcher for legacy Joomla `?task=` calls, e.g.:
     * /component/weaver?task=authorisation.playerLogin
     */
    public function dispatch(Request $request)
    {
        $task = $request->query('task', '');

        return match ($task) {
            'authorisation.playerLogin'   => $this->playerLogin($request),
            'authorisation.resetPassword' => $this->resetPassword($request),
            'authorisation.getToken'      => $this->getToken($request),
            'authorisation.loginWindow'   => $this->loginWindow($request),
            default                       => abort(404, 'Unknown task'),
        };
    }

    public function playerLogin(Request $request)
    {
        // Mimic Joomla Log::addLogger + add(json) (laravel channel below)
        Log::channel('playerlogin')->info('playerlogin request', [
            'payload' => $request->except(['password', 'encPwd']), // don't log secrets
            'ip'      => $request->ip(),
        ]); // mirrors the intention of the Joomla logger. 

        // Joomla code calls Session::sessionRemove() before starting. 
        if (method_exists(LegacySession::class, 'sessionRemove')) {
            LegacySession::sessionRemove();
        }

        $isAjax = $request->string('isAjax', '');
        Validations::$isAjax = ($isAjax === 'true');

        $userName    = $request->string('userName_email', '');
        $rawPassword    = $request->input('password', ''); // RAW in Joomla
        $loginToken  = $request->string('loginToken', '');
        $submitUrl   = $request->string('submiturl', null);
        // $encPwd      = $request->input('encPwd', ''); // RAW in Joomla
        $encPwd   = md5($rawPassword); // single MD5
        $hashedPw = md5($encPwd . $loginToken); 
        $password = $hashedPw;
        $requestData = [
            'userName'  => (string) $userName,
            'password'  => $password,
            'loginToken'=> (string) $loginToken,
            'requestIp' => Configuration::getClientIP(),
        ];

        // trackingCipher (reEncString) behavior preserved. 
        $trackingCipher = LegacySession::getSessionVariable('reEncString');
        $requestData['trackingCipher'] = $trackingCipher !== false ? $trackingCipher : '';

        $response = ServerCommunication::sendCall(ServerUrl::PLAYER_LOGIN, $requestData, Validations::$isAjax); // 
        Log::info(json_encode($response));
        if (Validations::getErrorCode() != 0) {
            LegacySession::setSessionVariable('verificationPending', true);
            LegacySession::setSessionVariable('verificationPendingUserName', (string) $userName);

            if (Validations::getErrorCode() == Errors::VERIFICATION_PENDING) {
                if (Validations::$isAjax) {
                    // return Redirection::ajaxExit(
                    //     Redirection::VERIFICATION_PENDING,
                    //     Constants::AJAX_FLAG_RELOAD,
                    //     Errors::TYPE_ERROR,
                    //     Validations::getRespMsg()
                    // ); // 
                }
                // return Redirection::to(Redirection::VERIFICATION_PENDING, Errors::TYPE_ERROR, Validations::getRespMsg());
            }

            if ($loginToken == Constants::IGE_LOGIN_TOKEN) { // IGELOGIN compatibility. 
                // return Redirection::to(config('app.url') . '/component/weaver?task=authorisation.loginWindow&error=' . urlencode(Validations::getRespMsg()));
            }

            if (Validations::$isAjax) {
                return Redirection::ajaxSendDataToView($response);
            }
            // return Redirection::to(Redirection::LOGIN, Errors::TYPE_ERROR, Validations::getRespMsg());
        }

        // Success: session + redirects exactly like Joomla. 
        if (method_exists(LegacySession::class, 'sessionInitiate')) {
            LegacySession::sessionInitiate($response);
        }
        LegacySession::setSessionVariable('fireLoginEvent', true);
        LegacySession::unsetSessionVariable('reEncString');
        LegacySession::setSessionVariable('encPwd', $encPwd);

        $redirectTo = $submitUrl ? urldecode((string) $submitUrl) : url('/');

        if (LegacySession::getSessionVariable('LOTTERY_LOGINREDIRECT') === true) {
            LegacySession::unsetSessionVariable('LOTTERY_LOGINREDIRECT');
            $redirectTo = (string) LegacySession::getSessionVariable('LOTTERY_pageToGo');
        }

        // Enrich response with links (kept as in Joomla). 
        $response->cashierLink = Redirection::CASHIER_INITIATE;
        $response->rummyLink   = Redirection::PLAY_RUMMY;

        if (Validations::$isAjax) {
            $response->path = $redirectTo;
            // return Redirection::ajaxSendDataToView($response);
        }

        if ($loginToken == Constants::IGE_LOGIN_TOKEN) {
            $playerId  = Utilities::getPlayerId();
            $token     = Utilities::getPlayerToken();
            // return Redirection::to($redirectTo . "&forceLogin=YES&playerId={$playerId}&merchantSessionId={$token}");
        }

        // return Redirection::to($redirectTo);
        return response()->view('weaver.login-window', [
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
        $error = (string) $request->query('error', '');
        $callBackURL = $request->query('callBackURL');
        $igedevice   = $request->query('igedevice');

        if (!is_null($igedevice)) {
            LegacySession::setSessionVariable('igedevice', $igedevice);
        }

        // Match the old behavior: wrap callback with fixed domain & urlencode. 
        $callBackURL = urlencode("http://ala-new.winweaver.com/InstantGameEngineOLD/" . $callBackURL);

        if (!LegacySession::getSessionVariable('callBackURL')) {
            LegacySession::setSessionVariable('callBackURL', $callBackURL);
        }

        return response()->view('weaver.login-window', [
            'error'       => $error,
            'callBackURL' => $callBackURL,
        ]);
    }
}
