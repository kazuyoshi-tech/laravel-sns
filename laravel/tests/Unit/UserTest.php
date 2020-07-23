<?php

namespace Tests\Unit;

use App\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $user = factory(User::class)->create();
        // $response = $this
        //     ->actingAs($user)
        //     ->get(route('articles.index'));
        
        // $response->assertStatus(200)
        //     ->assertViewIs('memo');

        // $response = $this->get('/login');
        // $response->assertStatus(200);
        //         // ->assertViewIs('welcome'); 

    }
}
