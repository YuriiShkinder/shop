<?php


Route::resource('/','IndexController',['only'=>['index'],'names'=>['index'=>'home']]);

Route::resource('/categories','CategoryController',['only'=>['show'],'parameters'=>['categories'=>'alias']]);
Route::get('/categories/{categories}/{down}',['uses'=>'CategoryController@down','as'=>'down']);

Route::resource('/articles','ArticleController',['only'=>['show']]);

Route::resource('comment','CommentController',['only'=>['store']]);

Route::get('login',['uses'=>'Auth\AuthController@showLoginForm'])->name('login');

Route::post('login',['uses'=>'Auth\AuthController@login']);

Route::get('logout',['uses'=>'Auth\AuthController@logout']);

Route::group(['prefix' => 'office','middleware'=> 'auth'],function (){

    Route::get('/{user}',['uses' => 'OfficeController@index','as' => 'office']);
    Route::match(['post'],'/{user}/editpass',['uses' => 'OfficeController@pass','as' => 'officePass']);
    Route::match(['get','post'],'/{user}/edit',['uses' => 'OfficeController@edit','as' => 'userEdit']);

});

Route::group(['prefix' => 'admin','middleware'=> 'auth'],function() {

    Route::get('/',['uses' => 'Admin\IndexController@index','as' => 'admin']);


});