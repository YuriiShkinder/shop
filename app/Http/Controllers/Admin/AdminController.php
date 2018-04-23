<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Gate;

class AdminController extends Controller
{
    protected $m_rep;
    protected $c_rep;
    protected $a_rep;
    protected $user;
    protected $template;
    protected $content=false;
    protected $title;
    protected $vars=[];


    public function __construct()
    {
        $this->user=Auth::user();
        if(!$this->user){
           return false;
        }
        return true;
    }


    public function renderOutput()
    {
        $style=\App\Style::all()->last();
        $this->vars=array_add($this->vars,'style',$style);
        $this->vars=array_add($this->vars,'title',$this->title);
        $menu=$this->getMenu();
        $navigation=view(env('THEME').'.admin.navigation')->with('menu',$menu)->render();
        $this->vars=array_add($this->vars,'navigation',$navigation);
        if($this->content){
            $this->vars=array_add($this->vars,'content',$this->content);
        }

        $footer=view(env('THEME').'.admin.footer')->render();
        $this->vars=array_add($this->vars,'footer',$footer);

        return view($this->template)->with($this->vars);
    }

    public function getMenu() {
        return \Menu::make('adminMenu', function($menu) {

            $menu->add('Категории',array('route'  => 'admin.categories.index'));
            $menu->add('Товары',array('route'  => 'admin.articles.index'));
            $menu->add('Меню',array('route'  => 'admin.menus.index'));
            $menu->add('Комментарии',array('route'  => 'admin.comments.index'));
            $menu->add('Стили',array('route'  => 'admin.styles.index'));



        });
    }


}
