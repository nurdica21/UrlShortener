<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;
use App\Services\SafeBrowsingService;
use App\Http\Requests\StoreShortenUrlRequest;

class UrlController extends Controller
{
    public function get($folder, Url $url)
    {
        if($url->folder != $folder){
            return abort(404);
        }

        return redirect($url->original_url);
    }

    public function getHostName($url)
    {
        $hostName = parse_url($url, PHP_URL_HOST);
        
        $hostName = str_replace('www.', '', $hostName);
         
        $hostName = preg_replace('/\.[a-z]+$/', '', $hostName);

        return $hostName;
    }

    public function store(StoreShortenUrlRequest $request)
    {
        $validatedRequest = $request->validated();

        $hostName = $this->getHostName($validatedRequest['url']);

        $isSafe = SafeBrowsingService::checkUrlSafety($validatedRequest['url']);

        if (!$isSafe) {
            return response()->json(['error' => 'The URL is not safe to shorten'], 400);
        }

        $shortUrl = Str::random(6);

        $existingUrl = Url::where('original_url', $validatedRequest['url'])->first();
        if ($existingUrl) {
            return response()->json(['short_url' => url("$hostName/$existingUrl->short_url")]);
        }
  
        Url::create([
            'original_url' => $validatedRequest['url'],
            'short_url' => $shortUrl,
            'folder' => $hostName
        ]);

        return response()->json(['short_url' => url("$hostName/$shortUrl")]);
    }
}
