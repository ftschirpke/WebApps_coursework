<?php

namespace App\ServiceContainers;

class CallOfDuty
{
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
        $this->csrf_token = $this->initialiseCsrfToken();
        
    }

    private function initialiseCsrfToken() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://s.activision.com/activision/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function playerInfo($player_name) {
        // $curl = curl_init();

        // $player_url = 'https://my.callofduty.com/api/papi-client/stats/cod/v1/title/mw/platform/battle/gamer/'
        // . 'iShot%252321899' . '/profile/type/mp';

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $player_url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // dd($response);
        // return $response;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://my.callofduty.com/api/papi-client/crm/cod/v2/platform/uno/username/Huskerrs/search',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-CSRF-TOKEN: ' . $this->apiKey,
            'Cookie: API_CSRF_TOKEN=' . $this->apiKey . '; ACT_SSO_COOKIE=en_US; ACT_SSO_COOKIE_EXPIRY=1591153892430; atkn=Set by test scripts;'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);
    }
}