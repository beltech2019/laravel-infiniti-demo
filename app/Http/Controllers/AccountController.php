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
}
