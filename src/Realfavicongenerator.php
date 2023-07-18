<?php

namespace Amarj\Realfavicongenerators;

use Curl;

class Realfavicongenerator
{
    protected string $file;

    public static function load(string $path): string
    {
        $instance = new static();

        $instance->file = file_get_contents($path);
       
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://openexchangerates.org/api/latest.json');

        echo $response->getStatusCode(); // 200
        echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
        die;

        return $instance;
    }
}