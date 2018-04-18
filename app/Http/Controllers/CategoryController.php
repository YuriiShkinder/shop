<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesReporitory;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use App\Menu;
class CategoryController extends SiteController
{
    public function __construct(CategoriesReporitory $c_rep)
    {
        $this->c_rep=$c_rep;
        $this->template=env('THEME').'.category';
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
        $articles=$category->articles()->paginate(2);
        $articles->transform(function ($item){
            $item->img=json_decode( $item->img);
            return $item;
        });


        $content=view(env('THEME').'.content_category')->with(['category'=>$category,'articles'=>$articles])->render();

        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }


}
