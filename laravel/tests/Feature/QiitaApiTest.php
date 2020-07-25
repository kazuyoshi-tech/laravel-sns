<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Mockery;

class QiitaApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetApi(): void
    {
        $mock = Mockery::mock('overload: https://yukicoder.me/api/v1/problems/')
            ->andReturn([
                'qiitas' => [
                'Title' => '競技プログラミング（yukicoder）',
                'Tag'   => '数理教徒多すぎて勝てません',
                ]
            ]);
    }
}
