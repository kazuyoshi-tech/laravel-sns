<?php

namespace App\Services;

class QiitaService {
    public function GetApi()
    {
        $client = new \GuzzleHttp\Client();
        
        return $client->request('GET', 'https://yukicoder.me/api/v1/problems/');
    }
}