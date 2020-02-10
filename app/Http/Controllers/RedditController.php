<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedditController extends Controller
{

    public static function reddit()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.reddit.com/subreddits/search.json?q=laravel&t=all",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Cookie: edgebucket=nT6uQGz5gG3FBixWxR; loid=00000000004glwyjp0.2.1566910807724.Z0FBQUFBQmVRVjVCVUgyLVlHbkkxdmRYV3FCMktCdjBHREdvNlpnTWphLWRRb2R1Y2NSMW9kWGRad3BBbGl6M2k4Xzl2MDRRLWp2eFA5RFNYVnZqZDl0QzNYY2ppUnBvekxabUJaSlBfNVJ3SW9POVUyR3pSWTNRaXVoVlEyNHR5T0dwQTZCbzRDVE0; csv=1; session_tracker=jMcMtntZyh6zpv4TBA.0.1581349111100.Z0FBQUFBQmVRWGozRUdBeEdmMVg5NGdNQTIzVEJhbnRHOUtlZDBoa0NUYVVQd1UyZ1dfa0szZnBvYzVpbmc3b3d0ckREdzR3em1uNXFTdlExOVJRejRWeTNwS21IMExlVERnY1JZdUdWNm5wWVNJelhXa2JGNnVROG94bFhHSTMzMDRQTVFRV0U3QnI",
                "Host: www.reddit.com",
                "User-Agent: PostmanRuntime/7.20.1",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json($err);
        }

        $data = json_decode($response, true)['data']['children'];

        return $data;
    }
}
