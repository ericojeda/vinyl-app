<?php

namespace App;

class CurlHelper
{
    public static function hitApi($url)
    {
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'record-app');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        return json_decode($query, true);
    }
}
