<?php

namespace Amarj\Realfavicongenerators;

use Exception;


class Realfavicongenerator
{
    
    const APP_URL =  'https://realfavicongenerator.net/api/favicon';

    const APP_KEY = 'f70d8ecc8432378d8f9256bf2d4051f6dc2d77df';
    protected string $file;

    public static function load(string $path):string
    {
        try{

            $file = base64_encode(file_get_contents($path));
            $genrateFavIcons = new GenrateFavIcons();
            $favDesign = $genrateFavIcons->favIconDesign(self::APP_KEY, $file);
    
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', self::APP_URL,[
                    'headers' => [
                    'Content-Type' => 'multipart/form-data'
                    ],
                    'body' => json_encode($favDesign)
            ]);
            $responseData = json_decode($response->getBody()->getContents(), true);
            $response = $genrateFavIcons->unZipIcons($responseData);
            return $response;

        }catch(Exception $e) {
            return "Error: ".$e->getMessage();
        }
        
    }
    
}