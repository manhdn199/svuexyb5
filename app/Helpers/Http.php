<?php

namespace App\Helpers;

use GuzzleHttp;

class Http
{

    public static function get($url)
    {
        $client = new GuzzleHttp\Client();

        return $client->get($url);
    }


    public static function post($url, $body)
    {
        $client = new GuzzleHttp\Client();

        try {
            $response = $client->post($url, ['form_params' => $body]);
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
        }

        return $response;
    }
}
