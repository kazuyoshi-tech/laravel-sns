<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザ作成
        $this->user = factory(User::class)->create();
    }

    /**
    * ログイン認証テスト
    */
    public function testLogin(): void
    {
        // 作成したテストユーザのemailとpasswordで認証リクエスト
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => $this->user->password,
        ]);

        // リクエスト送信後、正しいくリダイレクト処理されていることを確認
        $response->assertRedirect('/');

    }

    /**
    * ログアウトテスト
    */
    public function testLogout(): void
    {
        // actingAsヘルパで現在認証済みのユーザーを指定する
        $response = $this->actingAs($this->user);
 
        // ログアウトページへリクエストを送信
        $response->post(route('logout'));
 
        // ユーザーが認証されていないことを確認
        $this->assertGuest();
    }
}
