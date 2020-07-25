<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Services\QiitaService;

use Mockery;

class QiitaApiTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        #Qiitaデータ作成
        $this->apiresponse = ['qiitas' => [
            'title' => '競技プログラミング（yukicoder）',
            'body' => '数理教徒多すぎて勝てません',
        ]];
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetApi(): void
    {
        
        $ApiServiceMock = Mockery::mock('alias:QiitaService')
            ->shouldReceive('GetApi')
            ->once()
            ->andReturn([
                [
                    'Title' => '競技プログラミング（yukicoder）',
                    'Tags'   => '数理教徒多すぎて勝てません',
                ]   
            ])
            ->getMock();
        
        $this->app->bind(QiitaService::class, function () use ($ApiServiceMock) {
            return $ApiServiceMock;
        });

        $this->get(route('qiitas.index', ['qiitas' => $ApiServiceMock]))
            ->assertStatus(200);
            // ->assertSee($this->article->title);
    }
}
