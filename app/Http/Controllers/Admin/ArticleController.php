<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticlesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends AdminController
{
    public function __construct(ArticlesRepository $a_rep)
    {
        $this->a_rep=$a_rep;
        $this->template='pink'.'.admin.articles';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title='Товары';
        $articles=$this->a_rep->get('*',0,1,1);

        $content=view('pink'.'.admin.articles_content')->with('articles',$articles)->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title='Товары';
        $tmp=Category::all();
        $categories=$tmp->reduce(function ($return,$item){
            $return[$item->id]=$item->title;
            return $return;
        });

        $content=view('pink'.'.admin.articles_create_content')->with('categories',$categories)->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $result=$this->a_rep ->addArticle($request);
        if(is_array($result)&& !empty($result['error'])){
            return back()->with($result);
        }

        return redirect('/admin')->with($result);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->title='Редактирование товара';
        $tmp=Category::all();
        $categories=$tmp->reduce(function ($return,$item){
            $return[$item->id]=$item->title;
            return $return;
        });
        $article->load('categories');
        $article->img=json_decode($article->img);

        $content=view('pink'.'.admin.articles_create_content')->with(['article'=>$article,'categories'=>$categories])->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $result=$this->a_rep ->updateArticle($request,$article);
        if(is_array($result)&& !empty($result['error'])){
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        $result=$this->a_rep ->deleteArticle($article);
        if(is_array($result)&& !empty($result['error'])){
            return back()->with($result);
        }

        return redirect('/admin')->with($result);

    }
}
