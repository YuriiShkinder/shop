<?php

use Faker\Generator as Faker;

$factory->define(\App\Second_Categories::class, function (Faker $faker) {
    $categories=['Акция','Распродажа','Уценка'];
    $cat=$categories[rand(0,2)];
    $article=\App\Article::get();
    switch ($cat){
        case 'Акция' :
            $sale=30;
            break;
        case 'Распродажа'  :
            $sale=20;
            break;
        case 'Уценка' :
            $sale=10;
            break;
        default: $sale=15;
    }
    return [
        'title'=>$cat,
        'alias'=>$faker->unique()->word,
        'article_id'=>$article->random()->id,
        'sale'=>$sale
    ];
});
