<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\DownCategories;
use App\Repositories\CategoriesReporitory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
class CategoriesController extends AdminController
{
    public function __construct(CategoriesReporitory $c_rep)
    {
        $this->c_rep=$c_rep;
        $this->template='pink'.'/admin/category';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title='Категории';
         $category=$this->c_rep->get(['id','alias','title'])->load('down');
         $content=view('pink'.'.admin.category_content')->with('categories',$category)->render();
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
        $this->title='Нова категория';
        $tmp=$this->c_rep->get();
        $categories=$tmp->reduce(function ($returnCat,$item){
            $returnCat[$item->id]=$item->alias;
          return $returnCat;
        },['0' => 'Родительский пункт категории']);

        $content=view('pink'.'.admin.category_create')->with('categories',$categories)->render();
        $this->vars=array_add($this->vars,'content',$content);
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
        $data=$request->except('_token','alias','parent');
        $validator=Validator::make($data,[
            'title'=>'required'
        ]);

        $validator->sometimes('alias',"required|unique:categories|max:255",function ($input) {
            $category=Category::find($input->parent);

            return  $category ?  ($category->alias !== $input->alias) && !empty($input) : false ;

        });

        if($validator->fails()){
            return back()->withInput($data)->withErrors($validator);
        }
        if($request->input('alias')==''){
          $data['alias']=$this->c_rep->transliterate($request->input('title'));

        }else{
            $data['alias']=$request->input('alias');
        }


        if($request->input('parent')>0){

                $data['category_id']=$request->input('parent');
                DownCategories::create($data);
                return redirect()->route('admin')->with(['status'=>'Добавлено']);
        }else{
            if( $this->c_rep->model->fill($data)->save()){
                return redirect()->route('admin')->with(['status'=>'Добавлено']);
            }
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        $this->title='Редактирование категории';
        $tmp=$this->c_rep->get();
        $categories=$tmp->reduce(function ($returnCat,$item){
            $returnCat[$item->id]=$item->alias;
            return $returnCat;
        },['0' => 'Родительский пункт категории']);

        $content=view('pink'.'.admin.category_create')->with(['categories'=>$categories,'category'=>$category])->render();
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
    public function update(Request $request, Category $category)
    {

        $data=$request->except('_token','alias','parent');
        $validator=Validator::make($data,[
            'title'=>'required'
        ]);

        $validator->sometimes('alias',"required|unique:categories|max:255",function ($input) {
            $category=Category::find($input->parent);

            return  $category ?  ($category->alias !== $input->alias) && !empty($input) : false ;

        });

        if($validator->fails()){
            return back()->withInput($data)->withErrors($validator);
        }
        if($request->input('alias')==''){
            $data['alias']=$this->c_rep->transliterate($request->input('title'));

        }else{
            $data['alias']=$request->input('alias');
        }

       if($request->input('parent')>0){
           $data['category_id']=$request->input('parent');
           DownCategories::create($data);
           return redirect()->route('admin')->with(['status'=>'Обновлено']);

       }else{

            if( $category->update($data)){

                return redirect()->route('admin')->with(['status'=>'Обновлено']);

            }
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $result=$this->c_rep ->deleteCategory($category);
        if(is_array($result)&& !empty($result['error'])){
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }


    public function down(Request $request,Category $category,DownCategories $down){

        if($request->isMethod('delete')){
            if($down->delete()){
                return back()->with(['status'=>'Сылка удалена']);
            }
        }

        if($request->isMethod('put')){
            if($request->input('parent')>0){
                $down->update(['category_id'=>$request->input('parent')]);
                    return redirect()->route('admin')->with(['status'=>'Обновлено']);
            }else{
                $down->delete();
                return redirect()->route('admin')->with(['status'=>'Обновлено']);
            }

        }

        $this->title='Редактирование категории';
        $tmp=$this->c_rep->get();
        $categories=$tmp->reduce(function ($returnCat,$item){
            $returnCat[$item->id]=$item->alias;
            return $returnCat;
        },['0' => 'Родительский пункт категории']);

        $content=view('pink'.'.admin.down')->with(['categories'=>$categories,'category'=>$category,'down'=>$down])->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();

    }
}
