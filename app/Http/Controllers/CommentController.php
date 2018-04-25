<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Comment;
use Response;
class CommentController extends Controller
{

    public function store(Request $request)
    {


        $data=$request->except('_token','comment_post_ID','comment_parent');
        $data['article_id']=$request->input('comment_post_ID');
        $data['parent_id']=$request->input('comment_parent');
        $data['view']=0;
        if(isset($data['prompt']) && !empty($data['prompt'])){
          $data['prompt']=1;
            $data['view']=1;
          }

        $validator=Validator::make($data,[
            'article_id'=>'integer|required',
            'parent_id'=>'integer|required',
            'text'=>'string:required'
        ]);

        $validator->sometimes(['name','email'],'required|max:255',function ($input){
            return !Auth::check();
        });

        if($validator->fails()){
            return Response::json(['error'=>$validator->errors()->all()]);
        }

        $user=Auth::user();
        $comment=new Comment($data);
        if($user){
            $comment->user_id=$user->id;

        }

        $post=Article::find($data['article_id']);
        $post->comments()->save($comment);

        $comment->load('user');

        $data['id']=$comment->id;
        $data['name']=(!empty($data['name'])) ? $data['name'] : $comment->user->name;
        $data['img']=$comment->user->img;

        $view_coment=view(env('THEME').'.content_one_comment')->with('data',$data)->render();
        if(isset($data['prompt']) && !empty($data['prompt'])){
            return Response::json(['success'=>true,'comment'=>$view_coment,'data'=>$data]);
        }

        return Response::json(['success'=>false,'comment'=>'','data'=>$data]);

        exit();
    }

    public function commentLike($type,Comment $comment)
    {

        if ($type == 'like') {
            $comment->userDisLike = 0;

            if ($comment->userLike == 0) {

                $comment->userLike = 1;
                $comment->like = $comment->like + 1;
                $comment->save();
                return Response::json(['like' => $comment->like, 'dislike' => $comment->dislike]);
            } else {

                $comment->userLike = 0;
                if ($comment->like != 0) {
                    $comment->like = $comment->like - 1;
                }
                $comment->save();
                return Response::json(['like' => $comment->like, 'dislike' => $comment->dislike]);
            }
        } else {
            $comment->userLike = 0;

            if ($comment->userDisLike == 0) {
                $comment->like = $comment->like - 1;
                $comment->userDisLike = 1;
                $comment->dislike = $comment->dislike + 1;
                $comment->save();
                return Response::json(['like' => $comment->like, 'dislike' => $comment->dislike]);
            } else {
                $comment->userDisLike = 0;
                if ($comment->dislike != 0) {
                    $comment->dislike = $comment->dislike - 1;
                }
                $comment->save();
                return Response::json(['like' => $comment->like, 'dislike' => $comment->dislike]);
            }
        }

    }

}
