<?php

namespace App\Services;

use Carbon\Carbon;

class QiitaService {

    public function GetApi()
    {
        # API検索用ラッパー（Guzzle）のセットアップ
        $client = new \GuzzleHttp\Client();

        # APIを叩く
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
        $qiitas = json_decode($qiitas, true);

        // 結果をリターする配列を準備
        $result = collect();
        $count = 0;
        foreach($qiitas as $qiita) {
            // データの整形
            $tmpData = [
                'Title' =>  $qiita['Title'],
                'Tags'  =>  $qiita['Tags'],
                'Date'  =>  Carbon::parse($qiita['Date'])->format('Y/m/d')
            ];
            // 整形データをresultにpush
            $result->push($tmpData);
            $count += 1;
            if(25 < $count) {
            break;
            }
        }
        return $result;
    }
}