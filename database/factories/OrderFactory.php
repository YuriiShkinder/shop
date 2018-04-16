<?php

use Faker\Generator as Faker;

$factory->define(\App\Order::class, function (Faker $faker) {
    $user=\App\User::all()->random()->id;
    $article=\App\Article::all()->random();
    $count=rand(1,3);

    return [
        'user_id'=>$user,
        'article_id'=>$article->id,
        'count'=>$count,
        'price'=>$article->price * $count
    ];
});
