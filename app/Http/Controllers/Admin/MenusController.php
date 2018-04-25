<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class MenusController extends AdminController
{
    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep=$m_rep;
        $this->template='pink'.'.admin.category';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu=$this->getMenus();

        $this->content=view('pink'.'.admin.menu_content')->with('menus',$menu)->render();
        return $this->renderOutput();
    }

    public function getMenus(){
        $menu=$this->m_rep->get();
        if($menu->isEmpty()){
            return false;
        }

        return  \Menu::make('forMenuPart',function ($m) use ($menu){

            foreach ($menu as $item){
                if($item->parent_id ==0){

                    $m->add($item->title,$item->path)->id($item->id);
                }else{
                    if($m->find($item->parent_id)){
                        $m->find($item->parent_id)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }

        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->title = 'Новый пункт меню';

        $tmp = $this->getMenus()->roots();

        //null
        $menus = $tmp->reduce(function($returnMenus, $menu) {

            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;

        },['0' => 'Родительский пункт меню']);

        $this->content = view('pink'.'.admin.menu_create')->with(['menus'=>$menus])->render();

        return $this->renderOutput();

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->only('title');
        $rules=['title'=>'required|max:100'];
        $validator=Validator::make($data,$rules);
        if($validator->fails()){
            return back()->withInput($data)->withErrors($validator);
        }
        $data['path']=$request->input('custom_link');
        $data['parent_id']=$request->input('parent');

       if($this->m_rep->model->fill($data)->save()){
           return redirect()->route('admin')->with(['status'=>'Добавлено']);
       }
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


    public function edit(Menu $menu)
    {
        $this->title = 'Редактирование пункта меню';

        $type=false;
        $option=false;
            $type='customLink';
        $tmp = $this->getMenus()->roots();

        $menus = $tmp->reduce(function($returnMenus, $menu) {

            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;

        },['0' => 'Родительский пункт меню']);

        $this->content = view('pink'.'.admin.menu_create')->with(['menu'=>$menu,'type'=>$type,'option'=>$option,'menus'=>$menus])->render();


        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data=$request->only('title');
        $rules=['title'=>'required|max:100'];
        $validator=Validator::make($data,$rules);
        if($validator->fails()){
            return back()->withInput($data)->withErrors($validator);
        }
        $data['path']=$request->input('custom_link');
        $data['parent_id']=$request->input('parent');

        if($menu->update($data)){
            return redirect()->route('admin')->with(['status'=>'Обновлено']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
       if($menu->delete()){
           return redirect('/admin')->with(['status'=>'Удален пункт меню']);
       }
    }
}
