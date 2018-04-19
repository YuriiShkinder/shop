<?php

namespace App\Http\Controllers;

use App\Article;
use App\Menu;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;

class ArticleController extends SiteController
{
    public function __construct()
    {
        parent::__construct(new MenusRepository(new Menu()));
        $this->template=env('THEME').'.articles';

    }


    public function show(Article $article){

        $article->load('comments.user');

        if($article){
            $article->img=json_decode($article->img);
        }

        if(isset($article->id)){
            $this->title=$article->title;
        }

        $content=view(env('THEME').'.article_content')->with('article',$article)->render();

        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

}
