<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Article::class, function (Faker $faker) {

    $user = factory(User::class)->create();

    return [
        'title' => $faker->postcode,
        'body' => $faker->city,
        'user_id' => $user->id,
    ];
});
