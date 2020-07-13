<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            'name'       =>  'seeder_tester',
            'email'      =>  'seeder@seeder.com',
            'password'   =>   Hash::make('zxcvbnma1'),
        ]);
        DB::table("articles")->insert([
            'title'      =>  'シーダーでDB登録が可能かテスト',
            'content'    =>  'テステステステステステス',
            'user_id'    =>  1,
            'create_at'  =>  '2020-07-09 14:37:51',
            'update_at'  =>  '2020-07-09 14:37:51'
            ]);
    }
}
