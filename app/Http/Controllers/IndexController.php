<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Repositories\ArticlesRepository;
use App\Repositories\CategoriesReporitory;
use App\Repositories\MenusRepository;
use App\Second_Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndexController extends SiteController
{
    public function __construct( ArticlesRepository $a_rep,CategoriesReporitory $c_rep)
    {
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
        $sale=$this->getSale();
        $this->vars=array_add($this->vars,'categories',$categories);
        $content=view(env('THEME').'.content')->with(['sales'=>$sale,'categories'=>$categories])->render();
        $this->vars=array_add($this->vars,'content',$content);
        $sliders=view(env('THEME').'.slider')->with('sliders',$sliderItem)->render();
        $this->vars=array_add($this->vars,'sliders',$sliders);

        return $this->renderOutput();
    }
    public function getSale(){
        $sale=Second_Categories::get()->load('article.categories');
       // dd($sale->pluck('article.categories')->collapse()->unique('title'));
        return $sale;
    }

    public function getCategories(){
        $collection=Collection::make();

        $categories=$this->c_rep->get()->load('down','articles.second');
//        $collection->put('categories',$categories);
//        $collection->get('categories');
//        dd($collection->get('categories')->put('sale','12')->get('sale'));
//        dd($categories[0]->articles->pluck('second')->collapse());
        $categories->map(function ($item){
            $item->articles->map(function ($val){
                $val->img=json_decode($val->img);
           });
        });

        return $categories;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
