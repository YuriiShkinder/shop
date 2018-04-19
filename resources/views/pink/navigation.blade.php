
@if($menu)
    <div class="menu classic">
        <ul  id="nav" class="menu">
            @include(env('THEME').'.custemMenuItems',['items'=>$menu->roots()])
            @if(!Auth::user())


            <li style="float: right">{!! Html::link(route('login'),'Login',['class' => 'btn btn-the-salmon-dance-3 ','style'=>'padding:5px 20px;']) !!}</li>
           @else

                @can('VIEW_ADMIN')

                    <li >{!! Html::link(route('admin'),'Admin panel',['class' => 'btn btn-the-salmon-dance-3 ','style'=>'padding:5px 20px;']) !!}</li>
                @endcan
                <li >{!! Html::link(route('office',['user'=>Auth::user()->id]),'Room',['class' => 'btn btn-the-salmon-dance-3 ','style'=>'padding:5px 20px;']) !!}</li>

                <li style="float: right">{!! Html::link('logout','Logout',['class' => 'btn btn-the-salmon-dance-3 ','style'=>'padding:5px 20px;']) !!}</li>


                    @endif


        </ul>


    </div>
    @endif

