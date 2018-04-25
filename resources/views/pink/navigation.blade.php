
@if($menu)
    <div class="menu classic">
        <ul  id="nav" class="menu">
            @include('pink'.'.custemMenuItems',['items'=>$menu->roots()])
            <li class="office" >
                @guest
                <p >{!! Html::link(route('login'),'Login',['class' => 'btn btn-the-salmon-dance-3 ','style'=>'padding:5px 20px; font-size:14px; text-align:center;']) !!}</p>
                @else
                    <p>Личный кабинет</p>
                    <ul class="sub-menu">
                        @can('VIEW_ADMIN')
                            <li >{!! Html::link(route('admin'),'Admin panel',['style'=>'padding:5px 20px;']) !!}</li>
                        @endcan
                        <li >{!! Html::link(route('office',['user'=>Auth::user()->login]),'Room',['style'=>'padding:5px 20px;  ']) !!}</li>
                        <li >{!! Html::link('logout','Logout',['style'=>'padding:5px 20px;']) !!}</li>

                    </ul>

                    @endguest
            </li>
            <li class="cartUser">
                <img src="{{asset('pink').'/images/icons/for_button/cart.png'}}">
                <a style="display: inline-block" href="{{route('cart.index')}}">Корзина</a>
                <span>{{Cart::count()}}</span>
            </li>
            <li id="searchLi">
            <form style="height: 20px; position: absolute" class="form-inline " action="{{route('ajax')}}" method="post">
                @csrf
                <input id="search"  class="form-control mr-sm-2" type="text" placeholder="Поиск товара или категории">

            </form>

            </li>
        </ul>
    </div>
    @endif

