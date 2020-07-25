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

    public function setUp(): void
    {
        parent::setUp();

        // テスト記事
        $this->article = factory(Article::class)->create();
    }

    public function test_Can_Create_a_article()
    {
        $find_article = DB::table('articles')->where('id', $this->article->id)->first();

        $this->assertEquals($find_article->title, $this->article->title);
    }


    //     $product = 'apple';
    //     $cover = UploadedFile::fake()->image('file.png', 600, 600);

    //     $params = [
    //         'sku' => $this->faker->numberBetween(1111111, 999999),
    //         'name' => $product,
    //         'slug' => str_slug($product),
    //         'description' => $this->faker->paragraph,
    //         'cover' => $cover,
    //         'quantity' => 10,
    //         'price' => 9.95,
    //         'status' => 1,
    //     ];

    //     $product = new ProductRepository(new Product);
    //     $created = $product->createProduct($params);

    //     $this->assertInstanceOf(Product::class, $created);
    //     $this->assertEquals($params['sku'], $created->sku);
    //     $this->assertEquals($params['name'], $created->name);
    //     $this->assertEquals($params['slug'], $created->slug);
    //     $this->assertEquals($params['description'], $created->description);
    //     $this->assertEquals($params['cover'], $created->cover);
    //     $this->assertEquals($params['quantity'], $created->quantity);
    //     $this->assertEquals($params['price'], $created->price);
    //     $this->assertEquals($params['status'], $created->status);
    // }
}
