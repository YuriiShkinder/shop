<?php


Route::resource('/','IndexController',['only'=>['index'],'names'=>['index'=>'home']]);

Route::resource('/categories','CategoryController',['only'=>['index','show'],'parameters'=>['categories'=>'alias']]);

Route::resource('/articles','ArticleController',['only'=>['index','show']]);
