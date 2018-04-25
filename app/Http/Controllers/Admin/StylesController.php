<?php

namespace App\Http\Controllers\Admin;

use App\Style;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class StylesController extends AdminController
{
    public function __construct()
    {
        $this->template=env('THEME').'.admin.category';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title='Style';
        $style=Style::all()->last();
        $content=view(env('THEME').'.admin.styles')->with('style',$style)->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }



    public function update(Request $request, Style $id)
    {

        $data=$request->only('header','site');
        $rules=['header'=>'required|max:100','site'=>'required|max:100'];
        $validator=Validator::make($data,$rules);
        if($validator->fails()){
            return back()->withInput($data)->withErrors($validator);
        }

        if(DB::table('styles')->update($request->only('header','site'))){
            return redirect()->route('admin')->with(['status'=>'Обновлено']);
        }

    }

}
