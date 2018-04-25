@if (count($errors) > 0)
    <div class="box error-box">

        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach

    </div>
@endif


@if (session('status'))
    <div class="box success-box">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="box error-box">
        {{ session('error') }}
    </div>
@endif

@if($cartItems->isNotEmpty())

    <div class="row">
        <h3>Cart Items</h3>


        <table class="table table-hover">
            <thead>
            <tr>
                <th>img</th>
                <th>Name</th>
                <th>Price</th>
                <th>qty</th>

                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartItems as $cartItem)
                <tr>
                    <td><img src="{{($cartItem->options->has('img')) ? $cartItem->options->img : ''}}" alt=""></td>
                    <td>{{$cartItem->name}}</td>
                    <td>{{$cartItem->price}}$</td>
                    <td width="50px">
                        {!! Form::open(['route' => ['cart.update',$cartItem->rowId], 'method' => 'PUT']) !!}
                        <input name="qty" type="text" value="{{$cartItem->qty}}">
                        <input style="height :30px!important;float: left; font-size: 10px"  type="submit" class="btn btn-acid-grey-4" value="Ok">
                        {!! Form::close() !!}
                    </td>
                    <td>
                        <form action="{{route('cart.destroy',$cartItem->rowId)}}"  method="POST">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input class="button small alert" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach

            <tr>
                <td></td>
                <td>
                    Sub Total: $ {{Cart::subtotal()}} <br>
                </td>
                <td>Items: {{Cart::count()}}
                </td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

        <a href="{{route('cart.showForm')}}" class="button">Checkout</a>
    </div>
    @auth()
    @else
        <div id="overlay" style="display: block;">
            <div style="position: absolute; z-index: 5000; top:50%; left: 30%" >
                <a class="btn btn-acid-grey-1" href="{{route('login')}}">Перейти к форме входа на сайт</a>
                <button id="closeOverlay" class="btn btn-acid-grey-1">Продолжыть покупку</button>
            </div>
        </div><!-- Пoдлoжкa -->

    @endauth
    @else
    <h3>В корзине нет товаров</h3>
    @endif


