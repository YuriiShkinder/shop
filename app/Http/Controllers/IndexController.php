<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Menu;
use App\Repositories\ArticlesRepository;
use App\Repositories\CategoriesReporitory;
use App\Repositories\CommentsRepository;
use App\Repositories\MenusRepository;
use App\Second_Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;
use Response;
class IndexController extends SiteController
{
    public function __construct( ArticlesRepository $a_rep,CategoriesReporitory $c_rep,CommentsRepository $comments)
    {
        $this->comm_rep=$comments;
        $this->c_rep=$c_rep;
        $this->a_rep=$a_rep;
        parent::__construct(new MenusRepository(new Menu()));
        $this->template=env('THEME').'.index';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->getCategories();
        $this->title='Home';
        $sliderItem=$this->getSliders();
        $categories=$this->getCategories();
        $comments=$this->getComments();
dd(env('THEME'));
        $content=view(env('THEME').'.content')->with([
            'sales'=>$categories->get('sale'),
            'categories'=>$categories->get('categories'),
            'articles'=>$categories->get('articles'),
            'comments'=>$comments
        ])->render();
        $this->vars=array_add($this->vars,'content',$content);
        $sliders=view(env('THEME').'.slider')->with('sliders',$sliderItem)->render();
        $this->vars=array_add($this->vars,'sliders',$sliders);

        return $this->renderOutput();
    }

    public function getComments(){

        $comments=$this->comm_rep->model->groupBy('article_id')->select('article_id', DB::raw('count(article_id) as total'))->orderByDesc('total')->limit(5)->get()->load('article');
       $comments->transform(function ($item){

          return collect(['total'=>$item->total,'article'=>$item->article]);
       });


        return $comments;
    }

    public function getCategories(){
        $categories=$this->c_rep->get();
        $categories->load('articles.second.article');
        $collection=Collection::make();
        $collection->put('categories',Collection::make($categories));
        $collection->put('articles',Collection::make());

        $collection->put('sale',Collection::make());
        $categories->each(function ($item) use ($collection) {
           if($item->articles->pluck('second')->collapse()->isNotEmpty()){
              if($item->articles->pluck('second')->collapse()->count()>=2){
                   $collection->get('sale') ->put($item->id,$item->articles->pluck('second')->collapse()->random(2));
              }else{
                  $collection->get('sale') ->put($item->id,$item->articles->pluck('second')->collapse());
              }
           }

            if($item->articles->isNotEmpty()){
                if($item->articles->count()>=3){
                    $collection->get('articles')->put($item->id,$item->articles->random(3));
                }elseif($item->articles->count()==1){
                    $collection->get('articles')->put($item->id,$item->articles->random());
                }else{
                    $collection->get('articles')->put($item->id,collect());
                }

            }else{
                $collection->get('articles')->put($item->id,collect());
            }

        });


        $this->c_rep->check($collection->get('articles')->collapse());


return $collection;
    }


    public function getSliders(){

        $sliders=$this->a_rep->get(['id','title','desc','img','price'])->load('second')->filter(function ($item) {
            if($item->second->isNotEmpty()){
                return $item;
            }
        })->random(4);

        if($sliders->isEmpty()){

            return false;
        }

        return $sliders;
    }

    public function ajax(Request $request){


        if($request->ajax()){
            $str=$request->input('str');
            $article = Article::where('title','like',"%".$str."%")->get();
            $category= Category::where('title','like',"%".$str."%")->get();

            $content= view(env('THEME').'.search')->with(['categories'=>$category,'articles'=>$article])->render();

            return Response::json(['success'=>true,'content'=>$content]);
        }

        return Response::json(['success'=>false]);
    }

}
