<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

class ArticleTest extends TestCase
{

    use RefreshDatabase;

    public function test_Can_Create_a_article()
    {
        $this->article = factory(Article::class)->create();

        $find_article = DB::table('articles')->where('id', $this->article->id)->first();

        $this->assertEquals($find_article->title, $this->article->title);
        $this->assertEquals($find_article->body, $this->article->body);
    }

    public function test_Can_delete_a_article()
    {

        $this->article = factory(Article::class)->create();

        $delete_article = DB::table('articles')->where('id', $this->article->id)->delete();

        $this->assertDatabaseMissing('articles', ['id' => $this->article->id]);
    }
}
