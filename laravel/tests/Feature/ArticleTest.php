<?php

namespace Tests\Feature;

use App\Article;
use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // テスト記事+ユーザーの作成
        // $this->user = factory(User::class)->create();
        $this->article = factory(Article::class)->create();
    }

    public function testArticleIndex(): void
    {
        $response = $this->get(route('articles.index'))
            ->assertStatus(200)
            ->assertSee($this->article->user->name)
            ->assertSee($this->article->title)
            ->assertSee($this->article->body);
    }

    public function show(): void
    {
        $response = $this->get(route('articles.show' ,['article' => $this->article]))
            ->assertStatus(200)
            ->assertSee($this->article->user->name)
            ->assertSee($this->article->title)
            ->assertSee($this->article->body);
    }

    public function testArticleCreate_success(): void
    {
        // actingAsヘルパで現在認証済みのユーザーを指定する
        $response = $this->actingAs($this->article->user);
 
        $response->get(route('articles.create'))
            ->assertStatus(200);
    }

    public function testArticleCreate_fails(): void
    {
        #ユーザー認証なしで記事作成ページに行けない
        $response = $this->get(route('articles.create'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    public function testArticleEdit_success(): void
    {
        // actingAsヘルパで現在認証済みのユーザーを指定する
        $response = $this->actingAs($this->article->user);

        #ユーザー認証なしで記事作成ページに行けない
        $response = $this->get(route('articles.edit', ['article' => $this->article]))
            ->assertStatus(200)
            ->assertSee($this->article->title)
            ->assertSee($this->article->body);
    }








    // public function testLogin(): void
    // {
    //     // 作成したテストユーザのemailとpasswordで認証リクエスト
    //     $response = $this->post(route('login'), [
    //         'email' => $this->user->email,
    //         'password' => $this->user->password,
    //     ]);

    //     // リクエスト送信後、正しいくリダイレクト処理されていることを確認
    //     $response->assertRedirect('/');

    // }
}
