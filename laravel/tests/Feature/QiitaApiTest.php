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
        $this->ApiResponseDate = [
            ['Title' => '競技プログラミング（yukicoder）', 'Tags'   => '数理教徒多すぎて勝てません'],
        ];
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetApi(): void
    {
        $ApiResponseDate = $this->mock(QiitaService::class, function ($mock) {
            $mock
                ->shouldReceive('GetApi')
                ->once()
                ->andReturn($this->ApiResponseDate)
                ->getMock();
        });


        $this->get(route('qiitas.index'))
            ->assertStatus(200);
            // ->assertSee($ApiResponseDate[0]['Title']);
    }
}
