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

        $response = ServerCommunication::sendCall(ServerUrl::PLAYER_LOGIN, $requestData, Validations::$isAjax);

        if (isset($response->errorCode) && $response->errorCode == 0 && isset($response->playerLoginInfo)) {
            $userId = $response->playerLoginInfo->playerId;
            // Save whole $response (or only the needed fields) in cache
            Cache::put('user_session_' . $userId, $response, 60 * 24); // expires in 24 hours

            // Optionally, use Laravel session for basic web auth
            session(['user_id' => $userId]);
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
        $error = (string) $request->query('error', '');
        $callBackURL = $request->query('callBackURL');
        $igedevice   = $request->query('igedevice');
        $userId = session('user_id');
        $userSession = $userId ? Cache::get('user_session_' . $userId) : null;
        $balance = $userSession->playerLoginInfo->walletBean->totalBalance ?? 0;

        if (!is_null($igedevice)) {
            LegacySession::setSessionVariable('igedevice', $igedevice);
        }

        $callBackURL = urlencode("http://ala-new.winweaver.com/InstantGameEngineOLD/" . $callBackURL);

        if (!LegacySession::getSessionVariable('callBackURL')) {
            LegacySession::setSessionVariable('callBackURL', $callBackURL);
        }

        return response()->view('weaver.login-window', [
            'error'       => $error,
            'callBackURL' => $callBackURL,
            'userId' => $userId,
            'balance' => $balance
        ]);
    }

    public function logout(Request $request)
    {
        $userId = session('user_id');
        if ($userId) {
            Cache::forget('user_session_' . $userId);
            session()->forget('user_id');
        }
        return redirect('weaver/authorisation/login-window');
    }

}
