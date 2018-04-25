<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    $obj = new \stdClass();
    $obj->mini = $faker->imageUrl(55,55,call_user_func(function (){
        $c = array('abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife','fashion', 'nature', 'sports', 'technics', 'transport');
        return $c[array_rand($c)];
    }));
    $obj->max =  $faker->imageUrl(816,282,call_user_func(function (){
        $c = array('abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife','fashion', 'nature', 'sports', 'technics', 'transport');
        return $c[array_rand($c)];
    }));
    $obj->path = $faker->imageUrl(1024,768,call_user_func(function (){
        $c = array('abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife','fashion', 'nature', 'sports', 'technics', 'transport');
        return $c[array_rand($c)];
    }));

    $img=json_encode($obj);


    return [

        'title' =>$faker->text(20),
        'desc'=>$faker->text(500),
        'text'=>$faker->text(1000),
        'img'=>$img,
        'price'=>rand(50,500),
        'count'=>rand(10,100),

    ];
});
