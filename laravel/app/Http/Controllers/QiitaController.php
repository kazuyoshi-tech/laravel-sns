<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QiitaController extends Controller
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();

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

        $response = $client->request('GET', 'https://yukicoder.me/api/v1/problems/');

        $qiitas = $response->getBody()->getContents();

        $qiitas_array = json_decode($qiitas, true);

        return view('qiitas.index', ['qiitas' => $qiitas_array]);
    }
}
