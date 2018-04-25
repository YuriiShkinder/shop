<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Repositories\ArticlesRepository;
use App\Repositories\CommentsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends AdminController
{
    public function __construct(CommentsRepository $com_rep, ArticlesRepository $a_rep)
    {
        $this->a_rep=$a_rep;
        $this->com_rep=$com_rep;
        $this->template=env('THEME').'.admin.comments';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title='Комментарии';
        $content=view(env('THEME').'.admin.comment_menu')->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

    public function showArticle(){
        $articles=$this->a_rep->get('*',0,1,1);

        $this->title='Комментарии';
        $content=view(env('THEME').'.admin.comments_article_content')->with('articles',$articles)->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();

    }

    public function showComments(Request $request,Article $article){
        $article->load('comments.user');
        if($request->isMethod('post')){
            $comment=$article->comments()->where('id',$request->input('id'))->first();
            if($request->input('text')){
                if($comment->update($request->only('text'))){
                    return back()->with(['status'=>'Комментарии обновлен']);
                }
            }else{
                $comment->delete();
                return back()->with(['status'=>'Комментарии удален']);
            }

        }

        $this->title='Комментарии '.$article->title ;
        $content=view(env('THEME').'.admin.comment_content')->with('article',$article)->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

    public function checkComments(Request $request){
        if($request->isMethod('post')){

            $comment=$this->com_rep->model->where('id',$request->input('id'))->first();
            if($request->has('view')){
                $data['text']=$request->input('text');
                $data['view']=1;
                if($comment->update($data)){
                    return back()->with(['status'=>'Комментарий добавлен']);
                }
            }

        }

        $comments=$this->com_rep->model->where('view',0)->orderBy('id','desc')->get();
         $comments->load('user');

        $this->title='Комментарии';
        $content=view(env('THEME').'.admin.comments_check_content')->with('comments',$comments)->render();
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
