<?php
namespace App\Http\Controllers;
use App\Menu;
use App\Order;
use App\Product;
use App\Repositories\ArticlesRepository;
use App\Repositories\MenusRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Auth;
use Validator;
class CartController extends SiteController

{
    public function __construct(ArticlesRepository $a_rep)
    {
        $this->a_rep=$a_rep;
        $this->template='cart.cart';
        parent::__construct(new MenusRepository(new Menu()));

    }
    public function showForm(){
        $this->title='Оформление заказа...';
        $user=Auth::user();

        $content=view('cart.checkout')->with('user',$user)->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

    public function createOrder(Request $request){
        $cartItems=Cart::content();
        $data=$request->except(['_token']);
        $rules=[
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
        ];

        $validator=Validator::make($data,$rules);
        if($validator->fails()){
            return redirect()->route('cart.createOrder')->withInput($data)->withErrors($validator);
        }
        if(isset(Auth::user()->id)){
            $order=new Order();
            $data=[];
            foreach ($cartItems as $cartItem){
                $data['user_id']=Auth::user()->id;
                $data['article_id']=$cartItem->id;
                $data['count']=$cartItem->qty;
                $data['price']=$cartItem->price * $cartItem->qty;
               $order->create($data);

            }
            Cart::destroy();
            return redirect()->route('office',['user'=>Auth::user()->login])->with(['status'=>'Ваш заказ на обработке!']);
        }else{
            Cart::destroy();
            return redirect()->route('cart.index')->with(['status'=>'Ваш заказ на обработке!']);
        }

    }



    public function index()
    {
        $this->title='Корзина';
        $cartItems=Cart::content();

        $content=view('cart.index',compact('cartItems'))->render();
        $this->vars=array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }

    public function addItem($id)
    {
        $product=$this->a_rep->model::find($id);
        $product->img=json_decode($product->img);
        Cart::add($id,$product->title,1,$product->price, ['img' => $product->img->mini]);
        return back();
    }

    public function update(Request $request, $id)
    {
        Cart::update($id,['qty'=>$request->qty]);
        return back();
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back();
    }
}