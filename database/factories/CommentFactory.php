<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    $user=\App\User::all()->random()->id;
    $article=\App\Article::all()->random();
    return [
        'text'=>$faker->text(50),
        'parent_id'=>rand(0,10),
        'article_id'=>$article->id,
        'user_id'=>$user,
        'like'=>rand(0,10),
        'dislike'=>rand(0,5),
        'prompt'=>rand(0,1)

    ];
});
