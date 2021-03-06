<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

Breadcrumbs::register('categories.show', function ($breadcrumbs,$category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Article '.$category, route('categories.show',$category));
});
Breadcrumbs::register('articles.show', function ($breadcrumbs,$article) {


    $breadcrumbs->parent('categories.show',$article->categories->first()->alias);
    $breadcrumbs->push($article->title, route('articles.show',$article->id));
});
Breadcrumbs::register('filterComent', function ($breadcrumbs,$article,$filter) {

    $breadcrumbs->parent('home');
    $breadcrumbs->push('filter', route('filterComent',['article'=>$article->id,'filter'=>$filter]));
});
Breadcrumbs::register('down', function ($breadcrumbs,$cat,$down) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($cat->alias,route('categories.show',$cat->alias));
    $breadcrumbs->push($down->title, route('down',[$cat->alias,$down->alias]));
});

Breadcrumbs::register('login', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login', route('login'));
});

Breadcrumbs::register('office', function ($breadcrumbs,$user) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Личный кабинет', route('office',$user->login));
});

Breadcrumbs::register('cart.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Корзина', route('cart.index'));
});

Breadcrumbs::register('cart.showForm', function ($breadcrumbs) {
    $breadcrumbs->parent('cart.index');
    $breadcrumbs->push('Оформление заказа', route('cart.showForm'));
});

Breadcrumbs::register('userEdit', function ($breadcrumbs,$user) {

    $breadcrumbs->parent('office',$user);
    $breadcrumbs->push('Изминения личных даных', route('userEdit',$user->login));
});
Breadcrumbs::register('errors.404', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Page Not Found');
});

