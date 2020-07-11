<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QiitaController extends Controller
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request("GET", 'http://qiita.com/api/v2/authenticated_user/items',[
            'headers' => [
                'Authorization' => 'Bearer ' .ENV('qiita_token'),
                'Content-Type' => 'application/json'
            ]
        ]);

        $qiitas = $response->getBody();

        $qiitas_json = json_decode($qiitas, true);

        return view('qiitas.index', ['qiitas' => $qiitas_json]);
    }
}
