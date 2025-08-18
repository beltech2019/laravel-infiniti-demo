<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class Campaign
{
    public static function prepareCampaignTracking(Request $request)
    {
        // Replace Joomla session check with Laravel session logic
        if (Session::sessionValidate()) {
            return Redirect::to(URL::to('/')); // Home
        }

        $gsp = $request->input('gsp', '');

        if ($gsp) {
            $param = $request->input('param', '');
            $idVCommString = $request->input('tid', '');

            if (!empty($idVCommString)) {
                Session::setSessionVariable('idVCommString', $idVCommString);
            }

            if (!empty($param)) {
                $params = collect($request->post())->except([
                    'param', 'userName', 'mobile', 'reg_password', 'email'
                ])->toArray();

                if (empty($params)) {
                    $params = new \stdClass();
                }

                $requestArr = [
                    'encString' => $param,
                    'requestIp' => Configuration::getClientIP(),
                    'params'    => $params
                ];

                $response = ServerCommunication::sendCall(ServerUrl::PREPARE_CAMPAIGN_TREKKING, $requestArr);

                if (Validations::getErrorCode() != 0) {
                    if (Validations::getErrorCode() == 608) {
                        return Redirect::to(Redirection::CAMPAIGN_EXPIRED_LINK);
                    }
                    return Redirect::to(URL::to('/'));
                }

                if (Validations::getErrorCode() == 0) {
                    Session::setSessionVariable('reEncString', $response->reEncString);
                    Utilities::doGSPregistration(
                        $request->input('userName', ''),
                        $request->input('reg_password', ''),
                        $request->input('mobile', 0),
                        $request->input('email', ''),
                        $request->getRequestUri(),
                        $request->input('registrationType', ''),
                        $request->input('state', ''),
                        $request->input('submiturl', null),
                        $request->input('refercode', '')
                    );
                }
            }
        } else {
            $data = $request->input('data', '');
            $idVCommString = $request->input('tid', '');

            if (!empty($idVCommString)) {
                Session::setSessionVariable('idVCommString', $idVCommString);
            }

            Session::unsetSessionVariable("reEncString");

            if (!empty($data)) {
                $params = collect($request->query())->except(['data'])->toArray();

                if (empty($params)) {
                    $params = new \stdClass();
                }

                $requestArr = [
                    'encString' => $data,
                    'requestIp' => Configuration::getClientIP(),
                    'params'    => $params
                ];

                $response = ServerCommunication::sendCall(ServerUrl::PREPARE_CAMPAIGN_TREKKING, $requestArr);

                if (Validations::getErrorCode() != 0) {
                    if (Validations::getErrorCode() == 608) {
                        return Redirect::to(Redirection::CAMPAIGN_EXPIRED_LINK);
                    }
                    return Redirect::to(URL::to('/'));
                }

                if (Validations::getErrorCode() == 0) {
                    Session::setSessionVariable('reEncString', $response->reEncString);
                }
            }
        }
    }
}
