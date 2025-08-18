<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Api
{
    public static function gmailApiCallResponse(Request $request)
    {
        $auth_code = $request->input('code', '');

        if ($auth_code === '') {
            return Redirection::to(Redirection::REFER_A_FRIEND);
        }

        $fields = [
            'code'          => urlencode($auth_code),
            'client_id'     => urlencode(Constants::GOOGLE_CLIENT_ID),
            'client_secret' => urlencode(Constants::GOOGLE_CLIENT_SECRET),
            'redirect_uri'  => urlencode(Redirection::GOOGLE_CALLBACK),
            'grant_type'    => 'authorization_code',
        ];

        $post = http_build_query($fields);
        $result = self::curl('https://accounts.google.com/o/oauth2/token', $post);
        $response = json_decode($result);

        if (!isset($response->access_token)) {
            return [];
        }

        $accesstoken = $response->access_token;
        $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='
             . Constants::GOOGLE_MAX_RESULTS
             . '&alt=json&v=3.0&oauth_token='
             . $accesstoken;

        $xmlresponse = self::curl($url);
        $contacts = json_decode($xmlresponse, true);

        $return = [];
        if (!empty($contacts['feed']['entry'])) {
            foreach ($contacts['feed']['entry'] as $contact) {
                if (
                    isset($contact['title']['$t']) && $contact['title']['$t'] !== '' &&
                    isset($contact['gd$email'][0]['address']) && $contact['gd$email'][0]['address'] !== ''
                ) {
                    $return[] = [
                        'name'  => $contact['title']['$t'],
                        'email' => $contact['gd$email'][0]['address'],
                    ];
                }
            }
        }

        return $return;
    }

    public static function curl($url, $post = '')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($post !== '') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }

        curl_setopt($curl, CURLOPT_USERAGENT, Configuration::getDevice());
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $contents = curl_exec($curl);
        curl_close($curl);

        return $contents;
    }

    public static function sendIdListToWeaver($referType, $contacts, $referThrough)
    {
        return ServerCommunication::sendCall('', [
            'referType'   => $referType,
            'referThrough'=> $referThrough,
            'referalList' => $contacts
        ]);
    }

    public function socialCallToWeaver($referThrough, $status, $postId = '')
    {
        return ServerCommunication::sendCall('', [
            'postId'      => $postId,
            'referThrough'=> $referThrough,
            'postStatus'  => $status
        ]);
    }

    public function inviteFriendSocial($referThrough)
    {
        $response = ServerCommunication::sendCall(ServerUrl::REFER_A_FRIEND, [
            'referThrough'=> $referThrough,
            'referType'   => 'socialRefer',
            'inviteMode'  => 'EMAIL'
        ]);

        return json_decode($response);
    }

    public static function outlookApiCallResponse($code)
    {
        $fields = [
            'code'          => urlencode($code),
            'client_id'     => urlencode(Constants::OUTLOOK_CLIENT_ID),
            'client_secret' => urlencode(Constants::OUTLOOK_CLIENT_SECRET),
            'redirect_uri'  => urlencode(Redirection::OUTLOOK_CALLBACK),
            'grant_type'    => 'authorization_code'
        ];

        $post = http_build_query($fields);

        $result = self::curl('https://login.live.com/oauth20_token.srf', $post);
        $response = json_decode($result);

        if (isset($response->access_token)) {
            Session::put('access_token', $response->access_token);
        }

        $accesstoken = Session::get('access_token');
        $url = 'https://apis.live.net/v5.0/me/contacts?access_token=' . $accesstoken;

        $response = json_decode(file_get_contents($url), true);
        $data = $response['data'] ?? [];

        $contacts = [];
        foreach ($data as $item) {
            foreach (['preferred', 'account', 'business', 'personal', 'other'] as $type) {
                if (!empty($item['emails'][$type]) && self::searchArray($item['emails'][$type], $contacts)) {
                    $contacts[] = [
                        'name'  => $item['name'],
                        'email' => $item['emails'][$type]
                    ];
                }
            }
        }

        return $contacts;
    }

    public static function searchArray($email, $contacts)
    {
        if (empty($email)) {
            return false;
        }

        foreach ($contacts as $value) {
            if ($value['email'] === $email) {
                return false;
            }
        }

        return true;
    }
}
