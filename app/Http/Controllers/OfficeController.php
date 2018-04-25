<?php

namespace App\Http\Controllers;


use App\Menu;
use App\Repositories\MenusRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Response;
use Hash;
class OfficeController extends SiteController
{
    protected  $u_rep;
    public function __construct(UserRepository $u_rep)
    {
        $this->u_rep=$u_rep;
        parent::__construct(new MenusRepository(new Menu()) );
        $this->title='Личный кабинет';
        $this->template='pink'.'/office/office';
    }

    public  function index(User $user){

        $user->load('orders.article');

        $user->orders->unique('id')->transform(function ($item){
            if(is_string( $item->article->img)){
                $item->article->img=json_decode( $item->article->img);
            }
            return $item;
        });

        $content=view('pink'.'/office/content_office')->with('user',$user)->render();

        $this->vars=array_add($this->vars,'content',$content);

       return $this->renderOutput();
    }

    public function pass(Request $request){
        $rules=['password'=>'required|min:3','confirm'=>'required|min:3|same:password'];

        $validator=Validator::make($request->toArray(),$rules);

        if($validator->fails()){
            return Response::json(['error'=>$validator->errors()->all()]);
        }
        $user=Auth::user();
    ;
       $pass['password']= Hash::make(  $request->get('password'));

        if($user->update($pass)){
            return Response::json(['success'=>true]);
        }

    }

    public function edit( User $user,Request $request){
        if($request->isMethod('post')){
            $rules=[
                'name'=>'required|min:3|max:50',
                'email'=>'required|email',
                'address'=>'required',

            ];
            $validator=Validator::make($request->toArray(),$rules);
            $validator->sometimes('login','unique:users|max:255', function($input) {

                if(Auth::user()) {
                    $model = Auth::user();
                    return ($model->login !== $input->login)  && !empty($input->login);
                }
                return !empty($input->login);
            });
            if($validator->fails()){

                return redirect()->route('userEdit',['user'=>$user->login])->withErrors($validator);
            }

           $result= $this->u_rep->updateUser($request,$user);

            if(is_array($result)&& !empty($result['error'])){
                return back()->with($result);
            }

            return redirect(route('office',['user'=>$request->input('login')]))->with($result);
        }

        $content=view('pink'.'/office/edit')->with('user',$user)->render();

        $this->vars=array_add($this->vars,'content',$content);

        return $this->renderOutput();
    }
}
