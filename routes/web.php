<?php


Route::resource('/','IndexController',['only'=>['index'],'names'=>['index'=>'home']]);
Route::post('/ajax',['uses'=>'IndexController@ajax','as'=>'ajax']);

Route::resource('/categories','CategoryController',['only'=>['show'],'parameters'=>['categories'=>'alias']]);
Route::get('/categories/{categories}/{down}',['uses'=>'CategoryController@down','as'=>'down']);

Route::resource('/articles','ArticleController',['only'=>['show']]);
Route::get('/article/{article}/{filter}',['uses'=>'ArticleController@filterComent','as'=>'filterComent']);

Route::resource('comment','CommentController',['only'=>['store']]);
Route::post('/typeLike/{type}/{comment}',['uses'=>'CommentController@commentLike','as'=>'commentLike']);

Route::get('login',['uses'=>'Auth\AuthController@showLoginForm'])->name('login');

Route::post('login',['uses'=>'Auth\AuthController@login']);

Route::get('logout',['uses'=>'Auth\AuthController@logout']);

Route::match(['get','post'],'cart',['uses'=>'CartController@index'])->name('cart');

Route::group(['prefix' => 'office','middleware'=> 'auth'],function (){

    Route::get('/{user}',['uses' => 'OfficeController@index','as' => 'office']);
    Route::match(['post'],'/{user}/editpass',['uses' => 'OfficeController@pass','as' => 'officePass']);
    Route::match(['get','post'],'/{user}/edit',['uses' => 'OfficeController@edit','as' => 'userEdit']);

});

Route::group(['prefix' => 'admin','middleware'=> 'auth'],function() {

    Route::get('/',['uses' => 'Admin\IndexController@index','as' => 'admin']);

    Route::resource('/articles','Admin\ArticleController',['as'=>'admin']);

    Route::resource('/categories','Admin\CategoriesController',['as'=>'admin','parameters'=>['category'=>'alias']]);

    Route::match(['get','put','delete'],'/categories/{categories}/{down}/edit',['uses'=>'Admin\CategoriesController@down','as'=>'adminDown']);

    Route::resource('/comments','Admin\CommentsController',['as'=>'admin']);

    Route::resource('/styles','Admin\StylesController',['only'=>['index','update','edit'],'as'=>'admin']);

    Route::resource('/menus','Admin\MenusController',['as'=>'admin']);

    Route::resource('/styles','Admin\StylesController',['as'=>'admin']);



});