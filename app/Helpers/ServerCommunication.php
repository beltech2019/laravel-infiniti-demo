<?php
namespace App\Helpers;

class ServerCommunication {

    public static function sendCall($url, $data = array(), $isAjax = false, $isJson = true, $extra_headers = false, $methodType = '') {
        Validations::validateRequestResponseData($url, $data, true, $isAjax);
        $data['domainName'] = Configuration::DOMAIN_NAME;
        if ($url == ServerUrl::PLAYER_LOGIN ||
                $url == ServerUrl::PLAYER_REGISTRATION ||
                $url == ServerUrl::PLAYER_REGISTRATION_NEW ||
                $url == ServerUrl::WITHDRAWAL_REQUEST ||
                $url == ServerUrl::withdrawal_Poc ||
                $url == ServerUrl::OFFLINE_DEPOSIT_REQUEST ||
                $url == ServerUrl::PAYMENT_OPTIONS ||
                $url == ServerUrl::PREPARE_CAMPAIGN_TREKKING ||
                $url == ServerUrl::REFER_A_FRIEND) {
            $data['deviceType'] = Configuration::getDeviceType();
            $data['userAgent'] = Configuration::getDevice();
        }
        if ($url == ServerUrl::PLAYER_LOGIN || $url == ServerUrl::PLAYER_REGISTRATION || $url == ServerUrl::PLAYER_REGISTRATION_NEW) {
            $data['loginDevice'] = Configuration::getLoginDevice();
        }

        if ($url != ServerUrl::PLAYER_LOGIN &&
                $url != ServerUrl::PLAYER_REGISTRATION &&
                $url != ServerUrl::PLAYER_REGISTRATION_NEW &&
                $url != ServerUrl::FORGOT_PASSWORD &&
                $url != ServerUrl::CHECK_LOGIN && $url != ServerUrl::POST_LOGIN_DATA &&
                Session::sessionValidate()) {
            if (Utilities::getPlayerToken() !== false)
                $data['playerToken'] = Utilities::getPlayerToken();

            if ($url != ServerUrl::PLAYER_PROFILE && Utilities::getPlayerId() !== false)
                $data['playerId'] = Utilities::getPlayerId();
        }

        $baseUrl = ServerUrl::BASE_URL;	
        $URL = $baseUrl . $url;	
        if($url == ServerUrl::PAYMENT_OPTIONS ||
            $url == ServerUrl::FETCH_PENDING_WITHDRAWAL ||
            $url == ServerUrl::withdrawal_Poc ||
            $url == ServerUrl::WITHDRAWAL_OTP_RESEND){
            $ramPlayerInfo = Utilities::getRamPlayerInfoResponse();
            if($ramPlayerInfo->aliasName == "poc.igamew.com"){
            	$data['domainName'] = 'poc.igamew.com';
            }
            //$data['domainName'] = 'poc.igamew.com';	
            $baseUrl = ServerUrl::CASHIER_BASE_URL;	
            $URL = $baseUrl . $url; 	
        }else if($url == ServerUrl::BONUS_DETAILS_NEW){	
            $baseUrl = ServerUrl::BONUS_BASE;    	
            $header = array("accept: */*");	
            $URL = $baseUrl . $url;	
        }

        if ($isJson) {
            $header = array("Content-type: application/json");
        }


        if ($extra_headers !== false) {
            foreach ($extra_headers as $key => $value) {
                array_push($header, $key . ":" . $value);
            }
        }
        if ($methodType == 'GET') {
            if($url == ServerUrl::CAP_GAME_LIST){
        		$URL = $url;
        	}else if($url == ServerUrl::ART_GAME_BASEURL){
        		$URL = $url. "?" . http_build_query($data);
        	}else{
            		$URL = $baseUrl . $url . "?" . http_build_query($data);
            	}
        } else {
            $URL = $baseUrl . $url;
        }
        
        $dontCheck = false;
        if ($url == ServerUrl::POST_LOGIN_DATA || $url == ServerUrl::CHECK_LOGIN)
            $dontCheck = true;
        $startTime = date("Y-m-d H:i:s");
        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($isJson) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        if($methodType == ''){
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
        $response = curl_exec($curl);
        $endtimeTime = date("Y-m-d H:i:s");
        // echo "<pre>";
        // echo json_encode($data);
        // echo "<br>";
        // echo $response;

         Utilities::WeaverAccessLog($URL."---".date_default_timezone_get(),$startTime,$endtimeTime,$_SERVER['REQUEST_URI'] . "  Headers: ".json_encode($header),json_encode($data),$response);
        if ($response === false && !$dontCheck) {
            Session::sessionRemove();

            if ($isAjax) {
                Redirection::ajaxExit(Redirection::LOGIN, Constants::AJAX_FLAG_RELOAD, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
            } else {
                Redirection::to(Redirection::LOGIN, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
            }
        }
        curl_close($curl);
        $response = json_decode($response);
        if (!$dontCheck && $url != ServerUrl::ART_GAME_BASEURL) {
            Validations::validateRequestResponseData($url, $response, false, $isAjax);
        }
        return $response;
    }

    public static function sendCallRam($url, $data = array(), $isAjax = false, $isJson = true, $extra_headers = false, $requestType = 'POST') {
        Validations::validateRequestResponseData($url, $data, true, $isAjax);
        $data['domainName'] = Configuration::DOMAIN_NAME;

        if(!array_key_exists("aliasName",$data)){
            $data['aliasName'] = Configuration::DOMAIN_NAME;
        }

        if ($url == ServerUrl::RAM_LOGIN ||
            $url == ServerUrl::RAM_REGISTRATION ||
            $url == ServerUrl::MINI_REGISTRATION ||
            $url == ServerUrl::QR_LOGIN)
        {
            $data['deviceType'] = Configuration::getDeviceType();
            $data['userAgent'] = Configuration::getDevice();
            $data['loginDevice'] = Configuration::getLoginDevice();
        }
        if ($url != ServerUrl::RAM_LOGIN &&
            $url != ServerUrl::RAM_REGISTRATION &&
            $url != ServerUrl::FORGOT_PASSWORD &&
            $url != ServerUrl::CHECK_LOGIN && $url != ServerUrl::POST_LOGIN_DATA &&
            Session::sessionValidate()) {
            if (Utilities::getPlayerToken() !== false) {
                $data['playerToken'] = Utilities::getPlayerToken();
            }
            if (!($url == ServerUrl::PLAYER_PROFILE || $url == ServerUrl::RAM_VERIFY_EMAIL_OTP) && (Utilities::getPlayerId() !== false)) {
                $data['playerId'] = Utilities::getPlayerId();
            }
        }
        if($url == ServerUrl::GET_COUNTRY_LIST)
            $data['aliasName'] = Configuration::DOMAIN_NAME;
        if ($isJson) {
            if($url == ServerUrl::RAM_UDATE_PLAYER_PROFILE)
                $header = array("Content-type: multipart/form-data");
            else
                $header = array("Content-type: application/json");
            if (Utilities::getPlayerToken() !== false) {
                
                array_push($header, "playerToken: " . $data['playerToken']);
            }
            if (Utilities::getPlayerId() !== false) {
                array_push($header, "playerId: " . Utilities::getPlayerId());
            }
        }
        if ($extra_headers !== false) {
            foreach ($extra_headers as $key => $value) {
                array_push($header, $key . ":" . $value);
            }
        }

        array_push($header, "merchantCode: ".Configuration::RAM_MERCHANT_CODE);

        $dontCheck = false;
        if ($url == ServerUrl::POST_LOGIN_DATA || $url == ServerUrl::SAVE_SITE_OFFLINE) {
            $dontCheck = true;
        }

        if ($requestType == 'GET') {
            if($url == ServerUrl::PAM_CONFIG){
            $URL = $url . "?" . http_build_query($data);
            }else{
            $URL = ServerUrl::RAM_BASE . $url . "?" . http_build_query($data);
            }
        } else {
            $URL = ServerUrl::RAM_BASE . $url;
        }

        $startTime = date("Y-m-d H:i:s");
        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $request = json_encode($data);
        if ($isJson) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }

        if ($requestType == "PUT") {
            curl_setopt($curl, CURLOPT_PUT, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        else if ($requestType == 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        else if ($requestType == 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
        $response = curl_exec($curl);
        $endtimeTime = date("Y-m-d H:i:s");
        Utilities::WeaverAccessLog($URL, $startTime, $endtimeTime, $_SERVER['REQUEST_URI'] . "  Headers: ".json_encode($header), json_encode($data), $response);
        if ($response === false && !$dontCheck) {
            Session::sessionRemove();
            if ($isAjax) {
                Redirection::ajaxExit(Redirection::LOGIN, Constants::AJAX_FLAG_RELOAD, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
            } else {
                Redirection::to(Redirection::LOGIN, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
            }
        }
        curl_close($curl);
        $response = json_decode($response);
        if (!$dontCheck && $url != ServerUrl::PAM_CONFIG) {
            Validations::validateRequestResponseData($url, $response, false, $isAjax);
        }
        //die(json_encode($response));
        return $response;
    }

    public static function serverUploadImage($url, $data, $isAjax = false) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        if ($response === false) {
            Session::sessionRemove();
            if ($isAjax) {
                Redirection::ajaxSendDataToView(true, 1, Errors::SYTEM_ERROR);
            }
            Redirection::to(Redirection::LOGIN, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
        }
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }

    public static function serverUploadImageNew($url, $data, $isAjax = false)
    {
        $header = array("Content-Type: multipart/form-data;");

//        exit(json_encode($data));

        $curl = curl_init(ServerUrl::BASE_URL . $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($curl);
        Utilities::WeaverAccessLog($url,"","",$_SERVER['REQUEST_URI'],json_encode($data),$response);
        if ($response === false) {
//            Session::sessionRemove();
            if ($isAjax) {
                Redirection::ajaxSendDataToView(true, 1, Errors::SYTEM_ERROR);
            }
            Redirection::to(Redirection::LOGIN, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
        }
        curl_close($curl);
        $response = json_decode($response);
        return $response;
    }

    public static function sendCallToGameEngine($url, $data = array(), $isAjax = false, $isJson = true, $extra_headers = false, $ige = false, $isPost = true) {
        $headerArr = array(
            "User-Agent: " . $_SERVER['HTTP_USER_AGENT'],
            "appVersion: " . Constants::VERSION,
//            "reqChannel: ".Constants::REQUEST_CHANNEL
            "reqChannel: " . ""
        );
        if ($isJson) {
            array_push($headerArr, "Content-Type: application/json");
        }
        if ($extra_headers !== false) {
            foreach ($extra_headers as $k => $v) {
                array_push($headerArr, $k . ": " . $v);
            }
        }
        $playerToken = Utilities::getPlayerToken();
        if ($playerToken !== false) {
            array_push($headerArr, "sessionId: " . $playerToken);
        }
        if ($ige) {
            $deviceType = Configuration::getDeviceType();
            $appTypeAndClientType = Configuration::getAppAndClientType($deviceType);
            $url .= "&clientType=" . $appTypeAndClientType['CLIENTTYPE'] . "&deviceType=" . Configuration::getDeviceType() . "&appType=" . $appTypeAndClientType['APPTYPE'] . "&userAgentIge=" . urlencode(Configuration::getDevice());
        }
        //Validations::$isAjax = isAjax;
        $startTime = date("Y-m-d H:i:s");
//        exit(json_encode($url).'---'. json_encode($isPost));
        if ($isPost) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 110);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArr);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            $response = curl_exec($ch);
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 110);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArr);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            $response = curl_exec($ch);
        }
        $endtimeTime = date("Y-m-d H:i:s");
        Utilities::WeaverAccessLog($url,$startTime,$endtimeTime,$_SERVER['REQUEST_URI'],json_encode($data),$response);
        if (curl_errno($ch) !== 0 || $response === false) {
            Session::sessionRemove();
            if ($isAjax) {
                Redirection::ajaxExit(Redirection::LOGIN_PAGE, Constants::AJAX_FLAG_RELOAD, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
            } else {
                Redirection::to(Redirection::LOGIN_PAGE, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
            }
        }
        curl_close($ch);
        if (!$ige) {
            //$response = Validations::validateResponseFromEngine(json_decode($response, true), true, $isAjax);
        } else {
            //$response = Validations::validateResponseFromEngineIGE(json_decode($response, true), true, $isAjax);
        }
        return json_decode($response);
    }

    public static function serverUploadImageRam($url, $data, $isAjax = false) {
        $data['domainName'] =  Configuration::DOMAIN_NAME;
        $header = [];
        array_push($header, "Content-Type: multipart/form-data");
        if (Utilities::getPlayerToken() !== false) {
            array_push($header, "playerToken: " . Utilities::getPlayerToken());
        }
        if (Utilities::getPlayerId() !== false) {
            array_push($header, "playerId: " . Utilities::getPlayerId());
        }
        array_push($header, "merchantCode: ".Configuration::RAM_MERCHANT_CODE);

        $URL = ServerUrl::RAM_BASE . $url;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_CONNECTTIMEOUT => 30
        ));
        $response = curl_exec($curl);
        Utilities::WeaverAccessLog($URL,"","",$_SERVER['REQUEST_URI'] . "  Headers: ".json_encode($header),json_encode($data),$response);
        if ($response === false) {
            Session::sessionRemove();
            if ($isAjax) {
                Redirection::ajaxSendDataToView(true, 1, Errors::SYTEM_ERROR);
            }
            Redirection::to(Redirection::LOGIN, Errors::TYPE_ERROR, Errors::SYTEM_ERROR);
        }
        curl_close($curl);
        $response = json_decode($response);
        return $response;
    }

}