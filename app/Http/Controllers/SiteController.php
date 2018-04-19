<?php

namespace App\Http\Controllers;


use App\Category;
use App\Repositories\MenusRepository;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected $c_rep;
    protected $comm_rep;
    protected $a_rep;
    protected $m_rep;
    protected $title;
    protected $template;
    protected $vars=[];


    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep=$m_rep;

    }

    protected function renderOutput()
    {

        $menu=$this->getMenu();
        $navigation = view(env('THEME') . '.navigation')->with('menu',$menu)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        $footer=view(env('THEME').'.footer')->render();

        $this->vars=array_add($this->vars,'footer',$footer);
        $this->vars=array_add($this->vars,'title',$this->title);

        return view($this->template)->with($this->vars);

    }

    public function getMenu(){
        $menu=$this->m_rep->get();
        $mBuilder=\Menu::make('MyNav',function ($m) use ($menu){
            foreach ($menu as $item){
                if($item->parent_id==0){
                    $m->add($item->title,$item->path)->id($item->id);
                    if($item->title=='Категории'){
                        $cat=Category::all()->load('down');
                        foreach ($cat as $val) {
                            $m->find($item->id)->add($val->title, route('categories.show',['alias'=>$val->alias]))->id($m->last()->id);
                            $i=$m->last()->id;
                            if(!$val->down->isEmpty()){
                                foreach ($val->down as $k) {
                                    $m->find($i)->add($k->title, route('down',['category'=>$val->alias,'down'=>$k->alias]))->id($m->last()->id);

                                }
                            }
                        }
                    }

                }else{
                    if($m->find($item->parent_id)){
                        $m->find($item->parent_id)->add($item->title,$item->path)->id($item->id);
                    }

                }
            }
        });
        return $mBuilder;
    }
}
