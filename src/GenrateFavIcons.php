<?php

namespace Amarj\Realfavicongenerators;

use Exception;
use PSpell\Config;
use ZipArchive;

class GenrateFavIcons{
    const FILE_PATH = 'C:\Users\ankit\Downloads\favicons';

    public function favIconDesign($apiKey, $fileData){
        try{
            
            $designOptions = [
                'favicon_generation' => [
                    'api_key' => $apiKey,
                    'master_picture' => [
                        "type"=> "inline",
                        "content"=> $fileData
                    ],
                    'favicon_picture' => $fileData,
                    'favicon_design' => [
                        'desktop_browser' => [
                            'design' => 'raw'
                        ],
                        'windows' => [
                            'picture_aspect' => 'no_change',
                            'background_color' => '#da532c',
                            'on_conflict' => 'override',
                            'assets' => [
                                'windows_80_ie_10_tile' => true,
                                'windows_10_ie_11_edge_tiles' => [
                                    'small' => true,
                                    'medium' => true,
                                    'big' => true,
                                    'rectangle' => true
                                ]
                            ]
                        ]
                    ],
                ],
            ];

            return $designOptions;

        }catch(Exception $e) {
            return "Error: ".$e->getMessage();
        }
    }
    public function unZipIcons($responseData){
        try{
            if (!empty($responseData['favicon_generation_result']['favicon'])) {
               
                $faviconUrl = $responseData['favicon_generation_result']['favicon']['package_url'];
                $faviconPngUrl = $responseData['favicon_generation_result']['preview_picture_url'];

                $faviconData = file_get_contents($faviconUrl);
                $faviconPng = file_get_contents($faviconPngUrl);

                file_put_contents('favicon.zip', $faviconData);
                file_put_contents('favicon.png', $faviconPng);

                // To unzip a file 
                $file = 'favicon.zip';
                $extractZip = self::FILE_PATH;
                $zip = new ZipArchive;
                $res = $zip->open($file);

                if ($res === TRUE) {
                    $zip->extractTo($extractZip);
                    $zip->close();
                    return "WOO! $file extracted to $extractZip";
                }
                else {
                    return "Doh! I couldn't open $file";
                }
               
            } else {
                return 'Favicon data not found';
            }
        }catch(Exception $e) {
            return "Error: ".$e->getMessage();
        }
    }
}