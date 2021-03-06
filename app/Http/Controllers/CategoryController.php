<?php

namespace App\Http\Controllers;

use App\Category;
use App\DownCategories;
use App\Repositories\ArticlesRepository;
use App\Repositories\CategoriesReporitory;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use App\Menu;
class CategoryController extends SiteController
{
    public function __construct(CategoriesReporitory $c_rep,ArticlesRepository $a_rep)
    {
        $this->a_rep=$a_rep;
        $this->c_rep=$c_rep;
        $this->template='pink'.'.category';
        parent::__construct(new MenusRepository(new Menu()));
    }

    public function show($alias=false){

        $category=$this->c_rep->one($alias,['articles'=>true]);


        if($category){
            $category->articles->transform(function ($item){
                $item->img=json_decode( $item->img);
                return $item;
            });
        }

        if(isset($category->id)){
            $this->title=$category->title;

        }
        $articles=$category->articles()->paginate(5);
        $articles->transform(function ($item){
            $item->img=json_decode( $item->img);
            return $item;
        });


        $content=view('pink'.'.content_category')->with(['category'=>$category,'articles'=>$articles])->render();

        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

public function down(Category $category,DownCategories $down){

    if($down){
        $articles=$this->a_rep->one($down->article_id);
       $articles->transform(function ($item){
           $item->img=json_decode( $item->img);
           return $item;
       });

    }

        $this->title=$down->title;

    $content=view('pink'.'.content_category')->with(['category'=>$down,'articles'=>$articles])->render();

    $this->vars=array_add($this->vars,'content',$content);

    return $this->renderOutput();

}
}
