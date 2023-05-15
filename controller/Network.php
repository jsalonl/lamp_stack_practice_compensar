<?php

Class Network{

    public function getIp(){
        $url = 'https://api64.ipify.org?format=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $response = json_decode($response, true);
            return $response['ip'];
        } else {
            return "Unknown";
        }
    }

}