<?php

namespace App\Services;

class QiitaService {
    public function GetApi()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://yukicoder.me/api/v1/problems/');

        $qiitas = $response->getBody()->getContents();

        return json_decode($qiitas, true);
    }
}