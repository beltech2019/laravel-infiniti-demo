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
use Illuminate\Support\Facades\Storage;
use CURLFile;

class AccountController extends Controller
{
    function getPlayerBalance(Request $request) {
        $isAjax = true;
        if (LegacySession::sessionValidate()) {
            $refill = $request->input('refill', '');
            $refill = ($refill == 'true') ? true : false;
            $response = Utilities::getPlayerBalance($refill, $isAjax);
            $response->refill = $refill;
            Log::info(json_encode($response));
            return json_encode($response);
        }
    }

    public function profile(Request $request)
    {
        $transactionDetailsURL = "";
        $playerId = Utilities::getPlayerID();
        $playerToken = Utilities::getPlayerToken();
        $playerInfo = Utilities::getPlayerLoginResponse();
        $lang = 'en';
        $currencyInfo = Utilities::getCurrencyInfo();
        $currencyCode = $currencyInfo[0] ?? '';
        $dispCurrency = $currencyInfo[1] ?? '';
        $maxrowlimit = Constants::MAX_ROW_LIMIT;
        $domain_main = Configuration::DOMAIN_NAME;
        $ticketDomain = Configuration::DOMAIN;
        $tabactive = $request->tab;
        $transaction_option = Constants::$txnTypes_TransactionDetails['EN']; 
        return view('account.profile', compact('transaction_option', 'tabactive', 'ticketDomain', 'domain_main', 'maxrowlimit', 'playerInfo',  'lang', 'playerToken', 'playerId', 'transactionDetailsURL' , 'currencyInfo' , 'currencyCode' , 'dispCurrency'));
    }

    public function ticketsdetails(Request $request)
    {
        $transactionDetailsURL = "";
        $playerId = Utilities::getPlayerID();
        $playerToken = Utilities::getPlayerToken();
        $playerInfo = Utilities::getPlayerLoginResponse();
        $lang = 'en';
        $currencyInfo = Utilities::getCurrencyInfo();
        $currencyCode = $currencyInfo[0] ?? '';
        $dispCurrency = $currencyInfo[1] ?? '';
        $maxrowlimit = Constants::MAX_ROW_LIMIT;
        $domain_main = Configuration::DOMAIN_NAME;
        $ticketDomain = Configuration::DOMAIN;
        return view('account.ticketdetails', compact('ticketDomain', 'domain_main', 'maxrowlimit', 'playerInfo',  'lang', 'playerToken', 'playerId', 'transactionDetailsURL' , 'currencyInfo' , 'currencyCode' , 'dispCurrency'));
    }

    public function uploadPlayerAvatar(Request $request)
    {
        try {
            // Validate session (assuming your Utilities or Session helper has similar check)
            if (!LegacySession::sessionValidate()) {
                return redirect()->back()->withErrors(['error' => 'Session expired. Please login again.']);
            }
            $selectedAvatar = $request->input('selected_avatar', '');
            $userAvatar = $request->file('user_avatar');

            if ($userAvatar) {
                // Generate safe file name
                $fileName = $userAvatar->getClientOriginalName();
                $extension = $userAvatar->getClientOriginalExtension();

                $playerInfo = Utilities::getPlayerLoginResponse();
                $selectedAvatarName = $playerInfo->playerId . '_image.' . $extension;

                // Move file to tmp path
                $storedPath = $userAvatar->storeAs('playerAvatars', $selectedAvatarName, 'public');
                $tempPath = storage_path('app/public/' . $storedPath);
                // Resize using GD (same logic as Joomla code)
                list($width, $height) = getimagesize($tempPath);
                $ratio = $width / $height;
                $newWidth = 200;
                $newHeight = $newWidth / $ratio;
                $thumb = imagecreatetruecolor($newWidth, $newHeight);

                if ($extension === "jpg" || $extension === "jpeg") {
                    $source = imagecreatefromjpeg($tempPath);
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($thumb, $tempPath, 100);
                } elseif ($extension === "png") {
                    $source = imagecreatefrompng($tempPath);
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagepng($thumb, $tempPath, 0);
                } elseif ($extension === "gif") {
                    $source = imagecreatefromgif($tempPath);
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagegif($thumb, $tempPath);
                }

                // CURL File prepare
                $filesize = filesize($tempPath);
                $cfile = new \CURLFile($tempPath, $userAvatar->getMimeType());

                $data = [
                    "playerId" => Utilities::getPlayerId(),
                    "playerToken" => Utilities::getPlayerToken(),
                    "domainName" => Configuration::DOMAIN_NAME,
                    "isDefaultAvatar" => "N",
                    "file" => $cfile
                ];

                $response = ServerCommunication::serverUploadImageNew(
                    ServerUrl::UPLOAD_AVATAR,
                    $data,
                    true,
                    $filesize
                );
                unlink($tempPath);

                if (Validations::getErrorCode() == 0) {
                    Utilities::updatePlayerLoginResponse([
                        "avatarPath" => "/playerImages/" . $selectedAvatarName
                    ]);

                    return redirect()->back()->with('success', "Uploade Successfully");
                } else {
                    return redirect()->back()->withErrors(['error' => "Uploade Failed"]);
                }
            } elseif ($selectedAvatar) {

                $storedPath = $userAvatar->storeAs('playerAvatars', $selectedAvatar, 'public');
                $tempPath = storage_path('app/public/' . $storedPath);
                $filesize = filesize($tempPath);
                $cfile = new \CURLFile($tempPath, 'image/png');

                $data = [
                    "ImageFileName" => "akshay",
                    "playerId" => Utilities::getPlayerId(),
                    "playerToken" => Utilities::getPlayerToken(),
                    "domainName" => Configuration::DOMAIN_NAME,
                    "isDefaultAvatar" => "N",
                    "file" => $cfile
                ];

                $response = ServerCommunication::serverUploadImageNew(
                    ServerUrl::UPLOAD_AVATAR,
                    $data,
                    true,
                    $filesize
                );
                log::info(json_encode($response));

                if (Validations::getErrorCode() == 0) {
                    $selectedAvatarNew = Utilities::getPlayerId() . '_image.png';
                    Utilities::updatePlayerLoginResponse([
                        "avatarPath" => "/playerImages/" . $selectedAvatarNew
                    ]);

                    return redirect()->back()->with('success', $response);
                } else {
                    return redirect()->back()->withErrors(['error' => $response]);
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Invalid request.']);
            }

        } catch (\Exception $e) {
            Log::error("CURLFile creation failed: " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    function getTransactionDetails(Request $request) {
        if (LegacySession::sessionValidate()) {
            $txnType = $request->input('txnType', '');

            // Validate transaction type
            if ($txnType != Constants::TXNTYPE_TICKET_DETAILS) {
                if (array_key_exists($txnType, Constants::$txnTypes_TransactionDetails['EN']) === false) {
                    return json_encode([
                        "status" => "error",
                        "code"   => 1,
                        "message"=> "Invalid Transaction Type Received."
                    ]);
                }
            }

            $fromDate = $request->input('fromDate', '');
            $toDate   = $request->input('toDate', '');
            $offset   = (int) $request->input('offset', 0);
            $limit    = $request->input('limit', '');
            $fromDate = date('d/m/Y', strtotime($fromDate)); 
            $toDate = date('d/m/Y', strtotime($toDate)); 
            // Date and parameter validation
            if (!Validations::validateDate($fromDate)) {
                return json_encode(["status"=>"error","code"=>1,"message"=>"Please enter valid from date."]);
            }

            if (!Validations::validateDate($toDate)) {
                return json_encode(["status"=>"error","code"=>1,"message"=>"Please enter valid to date."]);
            }

            if (!Validations::compareDate($fromDate, $toDate)) {
                return json_encode(["status"=>"error","code"=>1,"message"=>"To date must be greater than or equal to from date."]);
            }

            if ($limit != Constants::MAX_ROW_LIMIT) {
                return json_encode(["status"=>"error","code"=>1,"message"=>"Invalid data received."]);
            }

            if ($offset < 0) {
                return json_encode(["status"=>"error","code"=>1,"message"=>"Invalid data received."]);
            }

            Log::info("hellombjgjh");
            if ($txnType == Constants::TXNTYPE_TICKET_DETAILS) {
                $response = ServerCommunication::sendCall(ServerUrl::TICKET_DETAILS, [
                    "txnType"  => $txnType,
                    "fromDate" => $fromDate,
                    "toDate"   => $toDate,
                    "offset"   => $offset,
                    "limit"    => $limit
                ], true);
            } else {
                $response = ServerCommunication::sendCall(ServerUrl::TRANSACTION_DETAILS, [
                    "txnType"  => $txnType,
                    "fromDate" => $fromDate,
                    "toDate"   => $toDate,
                    "offset"   => $offset,
                    "limit"    => $limit
                ], true);
            }

            // Error handling
            if (Validations::getErrorCode() == 0) {
                if ($txnType == Constants::TXNTYPE_TICKET_DETAILS) {
                    if (!isset($response->ticketList)) {
                        return json_encode(["status"=>"error","code"=>1,"message"=>"Invalid response received."]);
                    }
                    if (count($response->ticketList) == 0) {
                        return json_encode(["status"=>"error","code"=>1,"message"=>"No Ticket Details Found For Selected Date Range."]);
                    }
                } else {
                    if (!isset($response->txnList)) {
                        return json_encode(["status"=>"error","code"=>1,"message"=>"Invalid response received."]);
                    }
                    if (count($response->txnList) == 0) {
                        return json_encode(["status"=>"error","code"=>1,"message"=>"No Transaction Details Found For Selected Date Range."]);
                    }
                }

                // Wallet update logic
                if ($offset == 0 && $txnType != Constants::TXNTYPE_TICKET_DETAILS) {
                    $walletBean = Utilities::getPlayerLoginResponse()->walletBean;
                    $cashBalance = $response->txnList[0]->balance;
                    $withdrawableBal = $walletBean->withdrawableBal;
                    $totalBal = $walletBean->totalBalance;

                    if (strpos($withdrawableBal, ".") !== false) {
                        $withdrawableBal = substr($withdrawableBal, 0, strpos($withdrawableBal, "."));
                    }

                    $walletBean->cashBalance = $cashBalance;
                    $walletBean->withdrawableBalance = $withdrawableBal;
                    $walletBean->totalBalance = $totalBal;

                    Utilities::updatePlayerLoginResponse(["walletBean" => $walletBean]);

                    $response->cashBalance = $cashBalance;
                    $response->totalBalance = $totalBal;
                    $response->withdrawableBalance = $withdrawableBal;
                }
            }
            return response()->json([
                'view' => view('account.ticketdetails', compact('response'))->render(),
            ]);
        } else {
            return json_encode([
                "status"  => "error",
                "code"    => Constants::AJAX_FLAG_SESSION_EXPIRE,
                "message" => Errors::SESSION_EXPIRED
            ]);
        }
    }

    function getBonusDetails(Request $request) {
        if (LegacySession::sessionValidate()) {
            $fromDate = $request->input('fromDate', '');
            $toDate = $request->input('toDate', '');
            $offset = $request->input('offset', '');
            $limit = $request->input('limit', '');
            $isAjax = $request->input('isAjax', '');
            Validations::$isAjax = ($isAjax == 'true') ? true : false;
            if (!Validations::validateDate($fromDate)) {
                Redirection::ajaxSendDataToView(true, 1, 'Please enter valid from date.');
            }
            if (!Validations::validateDate($toDate)) {
                Redirection::ajaxSendDataToView(true, 1, 'Please enter valid to date.');
            }
            if (!Validations::compareDate($fromDate, $toDate)) {
                Redirection::ajaxSendDataToView(true, 1, 'To date must be greater than or equal to from date.');
            }
            if ($limit != Constants::MAX_ROW_LIMIT) {
                Redirection::ajaxSendDataToView(true, 1, 'Invalid data received.');
            }
            if ($offset < 0) {
                Redirection::ajaxSendDataToView(true, 1, 'Invalid data received.');
            }
            $response = ServerCommunication::sendCall(ServerUrl::BONUS_DETAILS, array(
                        "fromDate" => $fromDate,
                        "toDate" => $toDate,
                        "offset" => $offset,
                        "limit" => $limit
                            ), Validations::$isAjax);
            if (Validations::getErrorCode() == 0) {
                if (!isset($response->bonusList)) {
                    Redirection::ajaxSendDataToView(true, 1, 'Invalid response received.');
                }
                 if (count($response->bonusList) == 0) {
                    Redirection::ajaxSendDataToView(true, 1, JText::_('WEAVER_NO_BONUS_FOUND_MSG'));
                }
            }
            Redirection::ajaxSendDataToView($response);
        } else {
            Redirection::ajaxExit(Redirection::LOGIN, Constants::AJAX_FLAG_SESSION_EXPIRE, Errors::TYPE_ERROR, Errors::SESSION_EXPIRED);
        }
    }

    public function playerInbox(Request $request) {
        $isAjax = $request->input('isAjax', '');
        Validations::$isAjax = ($isAjax == 'true');
        if (LegacySession::sessionValidate()) {
            $offset = $request->input('offset', '');
            $limit = $request->input('limit', '');
            $responseArr = Utilities::playerInbox($offset, $limit);

            $tmpContent = [];
            foreach ($responseArr['content'] as $content) {
                $tmpContent[$content['id']] = json_decode($content['params'])->content;
            }

            unset($responseArr['response']->errorCode);

            $result = [
                'messages' => $responseArr['response'],
                'content' => $tmpContent,
                'errorCode' => Validations::getErrorCode(),
            ];

            if (Validations::getErrorCode() != 0) {
                $result['respMsg'] = Validations::getRespMsg();
            }

            return response()->json($result);
        }

        return response()->json([
            'errorCode' => 1,
            'respMsg' => 'Session expired',
            'redirect' => route('login'),
        ], 401);
    }


    public function inboxActivity(Request $request) {
        $activity = $request->input('activity', '');
        $msgId = $request->input('msgId', '');
        $isAjax = $request->input('isAjax', '');
        Validations::$isAjax = ($isAjax == 'true');
        $lang = 'en';

        if (LegacySession::sessionValidate()) {
            $offset = '';
            $limit = '';
            if (strtoupper($activity) == "DELETE") {
                $unreadCount = $request->input('unreadCount', 0);
                $offset = $request->input('offset', '');
                $limit = $request->input('limit', '');
                $msgId = explode("AND", $msgId);
                $tmpArr = [];
                foreach ($msgId as $msg) {
                    $tmpArr[] = (int) $msg;
                }
                $msgId = $tmpArr;
            }

            $requestArr = ["activity" => $activity];

            if (strtoupper($activity) == "READ") {
                $requestArr['inboxId'] = $msgId;
                $requestArr['local'] = $lang;
            } else {
                $requestArr['inboxIdList'] = $msgId;
                $requestArr['offset'] = $offset;
                $requestArr['limit'] = $limit;
                $requestArr['local'] = $lang;
            }

            $response = ServerCommunication::sendCall(ServerUrl::INBOX_ACTIVITY, $requestArr, Validations::$isAjax);

            if (Validations::getErrorCode() == 0) {
                Utilities::updatePlayerLoginResponse([
                    "unreadMsgCount" => $response->unreadMsgCount
                ]);

                if (strtoupper($activity) != "READ") {
                    if (Validations::getErrorCode() != 0) {
                        return response()->json($response);
                    }
                    Utilities::updatePlayerLoginResponse([
                        "unreadMsgCount" => $response->unreadMsgCount
                    ]);

                    if (count($response->plrInboxList) == 0) {
                        return response()->json([
                            'errorCode' => 1,
                            'respMsg' => 'No messages in inbox',
                        ]);
                    }

                    $ids = [];
                    foreach ($response->plrInboxList as $msg) {
                        $ids[] = $msg->content_id;
                    }

                    if (count($ids) == 0) {
                        return response()->json([
                            'errorCode' => 1,
                            'respMsg' => 'No messages content found',
                        ]);
                    }

                    $responseArr = [];
                    $responseArr['response'] = $response;

                    $tmpContent = [];
                    foreach ($response->plrInboxList as $content) {
                        $tmpContent[$content->inboxId] = $content->content_id;
                    }

                    unset($responseArr['response']->errorCode);

                    $result = [
                        'messages' => $responseArr['response'],
                        'content' => $tmpContent,
                        'errorCode' => Validations::getErrorCode(),
                        'unreadMsgCount' => Utilities::getPlayerLoginResponse()->unreadMsgCount,
                    ];

                    if (Validations::getErrorCode() != 0) {
                        $result['respMsg'] = Validations::getRespMsg();
                    }
                    return response()->json($result);
                }
            }
            return response()->json($response);
        }

        return response()->json([
            'errorCode' => 1,
            'respMsg' => 'Session expired',
            'redirect' => route('login'),
        ], 401);
    }


}
