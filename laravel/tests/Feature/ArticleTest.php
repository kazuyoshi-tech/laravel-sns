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

        #記事データ作成
        $this->articleDate_succuss = [
            'title' => '競技プログラミング',
            'body' => '中毒性あり、危険',
        ];
        $this->articleDate_fail = [
            'title' => '競技プログラミング',
        ];
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

    public function testArticleCreate_Success(): void
    {
        // actingAsヘルパで現在認証済みのユーザーを指定する
        $response = $this->actingAs($this->article->user);
 
        $response->get(route('articles.create'))
            ->assertStatus(200);
    }

    public function testArticleCreate_Fails(): void
    {
        #ユーザー認証なしで記事作成ページに行けない
        $response = $this->get(route('articles.create'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    public function testArticleEdit_Success(): void
    {
        // actingAsヘルパで現在認証済みのユーザーを指定する
        $response = $this->actingAs($this->article->user);

        #記事作成ユーザーで記事更新ページに行ける
        $response = $this->get(route('articles.edit', ['article' => $this->article]))
            ->assertStatus(200)
            ->assertSee($this->article->title)
            ->assertSee($this->article->body);
    }

    public function testArticleEdit_Fail_Guest(): void
    {
        #ユーザー認証なしで記事更新ページに行けない
        $response = $this->get(route('articles.edit', ['article' => $this->article]))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    public function testArticleEdit_Fail_OtherUser(): void
    {
        #アナザーユーザーの作成＋ログイン+アナザーユーザーでは許可されていない
        $this->otherUser = factory(User::class)->create();
        $response = $this->actingAs($this->otherUser)
            ->get(route('articles.edit', ['article' => $this->article]))
            ->assertStatus(403);
    }

    public function testArticleStore_Success(): void
    {
        #アナザーユーザーの作成＋ログイン+記事を投稿
        $this->otherUser = factory(User::class)->create();
        $this->actingAs($this->otherUser)
            ->post(route('articles.store'), $this->articleDate_succuss)
            ->assertStatus(302)
            ->assertSessionHas('flash_message', '投稿が完了しました')
            ->assertRedirect(route('articles.index'));
    }

    public function testArticleStore_fail(): void
    {
        #アナザーユーザーの作成＋ログイン+bodyの記述がなく'flash_message'がない
        $this->otherUser = factory(User::class)->create();
        $response = $this->actingAs($this->otherUser)
            ->post(route('articles.store'), $this->articleDate_fail)
            ->assertStatus(302)
            ->assertSessionHas('flash_message', '') #メッセージがない
            ->assertRedirect(route('articles.index'));
    }

    public function testArticleUpdate_Success(): void
    {
        #既に投稿している記事のユーザーでログイン
        $response = $this->actingAs($this->article->user)
            ->put(route('articles.update' ,['article' => $this->article], $this->articleDate_succuss))
            ->assertStatus(302)
            ->assertRedirect(route('articles.index'));
        
    }


}
