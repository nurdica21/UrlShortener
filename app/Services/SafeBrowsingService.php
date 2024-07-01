<?php

namespace App\Services;
use GuzzleHttp\Client;

class SafeBrowsingService
{
    public static function checkUrlSafety($url)
    {
        $googleSafeBrowsingApiKey = config('services.google_safe_browsing.api_key');
        $client = new Client();
        $response = $client->post('https://safebrowsing.googleapis.com/v4/threatMatches:find', [
            'query' => ['key' => $googleSafeBrowsingApiKey],
            'json' => [
                'threatInfo' => [
                    'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING', 'UNWANTED_SOFTWARE', 'POTENTIALLY_HARMFUL_APPLICATION'],
                    'platformTypes' => ['ANY_PLATFORM'],
                    'threatEntryTypes' => ['URL'],
                    'threatEntries' => [
                        ['url' => $url]
                    ]
                ]
            ]
        ]);

        $body = json_decode($response->getBody(), true);

        return empty($body['matches']);
    }
}
