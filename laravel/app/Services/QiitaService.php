<?php

namespace App\Services;

class QiitaService {
    public function GetApi()
    {
        # API検索用ラッパー（Guzzle）のセットアップ
        $client = new \GuzzleHttp\Client();

        // APIを叩く
        $response = $client->request('GET', 'https://yukicoder.me/api/v1/problems/');
        // $response = $client->request("GET", 'https://qiita.com/api/v2/items/',[
        //     'headers' => [
        //         'Authorization' => 'Bearer ' .ENV('qiita_token'),
        //         'Content-Type' => 'HTTP/1.1'
        //     ],
        //     'query' => [
        //         'query' => 'python',
        //         'per_page' => 1,                
        //     ],
            
        // ]);

        #　APIレスポンスの取り出し
        $qiitas = $response->getBody()->getContents();

        # JSONを連想配列に変換してリターン
        return json_decode($qiitas, true);
    }
}