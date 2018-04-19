<?php
/**
 * Created by PhpStorm.
 * User: yurii
 * Date: 16.04.18
 * Time: 18:56
 */

namespace App\Repositories;


use App\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model=$article;
    }
    public function one($alias,$attr=[]){
        return $this->model->where('id',$alias)->paginate(2);
    }
}