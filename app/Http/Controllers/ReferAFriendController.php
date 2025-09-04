<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Validations;
use App\Helpers\Errors;
use App\Helpers\Configuration;
use App\Helpers\ServerCommunication;
use App\Helpers\ServerUrl;
use App\Helpers\Utilities;
use App\Helpers\Constants;
use App\Helpers\Session as LegacySession;
use Log;

class ReferAFriendController extends Controller
{
    public function inviteFriend(Request $request)
    {
        if (LegacySession::sessionValidate()) {
            LegacySession::setSessionVariable('refer_a_friend', true);
            $referType = $request->input('referType', '');
            $inviteMode = $request->input('inviteMode', '');

            if ($referType === "socialRefer") {
                $referThrough = $request->input('referThrough', '');
                $response = ServerCommunication::sendCall(ServerUrl::REFER_A_FRIEND, [
                    "referThrough" => $referThrough,
                    "referType" => $referType,
                    "inviteMode" => $inviteMode
                ]);
            } else {
                $referalList_Arr[] = [
                        "firstName" => $request->firstName,
                        "lastName" => $request->lastName,
                        "emailId" => $request->emailId,
                        "mobileNo" => $request->mobileNo
                    ];

                $response = ServerCommunication::sendCall(ServerUrl::REFER_A_FRIEND, [
                    "referalList" => $referalList_Arr,
                    "referType" => $referType,
                    "inviteMode" => $inviteMode
                ]);
            }

            if (Validations::getErrorCode() == 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => __('message2.INVITATION_SENT')
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => $response->respMsg ?? __('message2.INVITATION_FAILED')
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('message2.SESSION_EXPIRED')
        ]);
    }

    public function gmailRefer()
    {
        if (LegacySession::sessionValidate() && Utilities::checkLogin(Utilities::getPlayerToken())) {
            $client = new \Google_Client();

            $client->setApplicationName(Constants::GMAIL_APP_NAME);
            $client->setClientId(Constants::GOOGLE_CLIENT_ID);
            $client->setClientSecret(Constants::GOOGLE_CLIENT_SECRET);
            $client->setRedirectUri(Configuration::GOOGLE_CALLBACK);
            $client->setAccessType('online');
            $client->setApprovalPrompt('force');
            $client->setScopes('https://www.google.com/m8/feeds');

            $googleImportUrl = $client->createAuthUrl();

            return response()->json([
                'status' => 'success',
                'url' => $googleImportUrl
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('message2.SESSION_EXPIRED')
        ]);
    }

    public function facebookRefer()
    {
        if (LegacySession::sessionValidate() && Utilities::checkLogin(Utilities::getPlayerToken())) {
            $referThrough = request()->input('referThrough', '');
            Validations::setErrorCode(0); // Assuming resetting error code or managing elsewhere

            if (Validations::getErrorCode() === 0) {
                LegacySession::setSessionVariable('refer_a_friend', true);

                $share_url = url('/'); // Laravel url helper in place of JUri::base()
                if (Validations::getErrorCode() === 0) {
                    $share_url = Validations::getRespMsg();
                }

                $facebook_url = "https://www.facebook.com/dialog/feed?app_id=" . Constants::FACEBOOK_APP_ID .
                    "&display=popup&link=" . urlencode($share_url) .
                    "&redirect_uri=" . urlencode(Configuration::FACEBOOK_CALLBACK);

                return response()->json([
                    'status' => 'success',
                    'url' => $facebook_url
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => __('message2.INVALID_ERROR_CODE')
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('message2.SESSION_EXPIRED')
        ]);
    }

    public function twitterRefer()
    {
        if (LegacySession::sessionValidate() && Utilities::checkLogin(Utilities::getPlayerToken())) {
            $referThrough = request()->input('referThrough', '');
            $text = Constants::TWITTER_REFER_TEXT;
            Utilities::getReferralLink($referThrough);

            $url = url('/'); // Laravel helper for base URL
            if (Validations::getErrorCode() === 0) {
                $url = Validations::getRespMsg();
            }

            $hashtag = Constants::TWITTER_HASHTAG;

            $twitter_url = "https://twitter.com/share?text=" . urlencode($text) .
                "&url=" . urlencode($url) .
                "&hashtags=" . urlencode($hashtag);

            return response()->json([
                'status' => 'success',
                'url' => $twitter_url
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => Errors::PLEASE_LOGIN_FIRST
        ]);
    }

    public function sendReminder(Request $request)
    {
        if (LegacySession::sessionValidate()) {
            $reminderList = json_decode($request->input('reminderList', '[]'));
            $reminderList_Arr = [];

            foreach ($reminderList as $item) {
                $subArr = [];
                if (!empty($item->userName) && $item->userName !== 'null' && $item->userName !== 'undefined')
                    $subArr['userName'] = $item->userName;
                if (!empty($item->emailId) && $item->emailId !== 'null' && $item->emailId !== 'undefined')
                    $subArr['emailId'] = $item->emailId;
                if (!empty($item->mobileNo) && $item->mobileNo !== 'null' && $item->mobileNo !== 'undefined')
                    $subArr['mobileNo'] = $item->mobileNo;

                $reminderList_Arr[] = $subArr;
            }

            $response = ServerCommunication::sendCall(ServerUrl::REFER_A_FRIEND_REMINDER, [
                "notificationDataBean" => $reminderList_Arr
            ]);

            if (Validations::getErrorCode() == 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => Errors::REFER_A_FRIEND_REMINDER_SENT
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => Validations::getRespMsg()
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('message2.SESSION_EXPIRED')
        ]);
    }

    public function trackBonus(Request $request)
    {
        $isAjax = $request->input('isAjax', 'false') === 'true';

        Validations::$isAjax = $isAjax;

        if (LegacySession::sessionValidate()) {
            $data = Utilities::trackBonus($isAjax);
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }

        if ($isAjax) {
            return response()->json([
                'status' => 'error',
                'redirect' => route('login'),
                'message' => __('message2.SESSION_EXPIRED'),
                'code' => Constants::AJAX_FLAG_SESSION_EXPIRE
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('message2.SESSION_EXPIRED')
        ]);
    }

}
