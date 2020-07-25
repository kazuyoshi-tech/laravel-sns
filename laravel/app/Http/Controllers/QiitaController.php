<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QiitaService;

class QiitaController extends Controller
{
    protected $QiitaService;

    public function __construct(QiitaService $QiitaService)
    {
        $this->QiitaService = $QiitaService;
    }

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

        // $response = $client->request('GET', 'https://yukicoder.me/api/v1/problems/');

        $response = $this->QiitaService->getApi();

        $qiitas = $response->getBody()->getContents();

        $qiitas_array = json_decode($qiitas, true);

        return view('qiitas.index', ['qiitas' => $qiitas_array]);
    }
}
