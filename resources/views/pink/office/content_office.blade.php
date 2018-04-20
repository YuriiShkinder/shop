<div class="container" style="margin-top: 50px">
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

    <div id="modal_form">
        <span id="modal_close">X</span>
        {!! Form::open(array('route' => array('officePass', $user->login),'method'=>'post','class'=>'resetPass','id'=>'formPass')) !!}

        <div class="form-group">
            <label for="pwd">Password:</label>
            <input name="password" type="password" class="form-control" id="pwd" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="cpwd">Confirm Password:</label>
            <input name="confirm" type="password" class="form-control" id="cpwd" autocomplete="off">
        </div>
        <button id="resetPass"  class="btn btn-default">Submit</button>
        {!! Form::close() !!}
    </div>
    <div id="overlay"></div><!-- Пoдлoжкa -->


    <div class="row">
        <div class="col-sm-3 roomRight" >
            <div class="list-group">
                <button style="cursor:pointer;" class="list-group-item " id="go">Изменить пароль</button>
                <a style="text-align: center; color: black; font-size: 16px" href="{{route('userEdit',['user'=>$user->login])}}" class="list-group-item " > Изменить данные</a>

            </div>

        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-4 " style="display: flex; justify-content:center " >
                    <img class="userAvatar" src="{{$user->img}}">
                </div>
                <div class="col-sm-8">
                    <table class="table table-hover">
                        <tr>
                            <td>Name:</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>Login:</td>
                            <td>{{$user->login}}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td>{{$user->address}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="text-align: center">История покупок</h3>
                    @if($user->orders->isNotEmpty())
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>article</th>
                            <th>image</th>
                            <th>count</th>
                            <th>price</th>
                            <th>data</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($user->orders as $order )
                        <tr>
                            <td>{{$order->article->title}}</td>
                            <td><img src="{{$order->article->img->mini}}"></td>
                            <td>{{$order->count}}</td>
                            <td>{{$order->price}} $</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        @endif
                </div>
            </div>
        </div>

    </div>

</div>
