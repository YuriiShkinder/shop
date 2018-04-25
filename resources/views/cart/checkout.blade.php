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

<div class="row ">
        <div class="small-6 small-centered columns ">
            <h3>Shipping Info</h3>

            {!! Form::open([route('cart.createOrder'), 'method' => 'post']) !!}
            <div class="form-group">
                {{ Form::label('name', 'name') }}
                {{ Form::text('name', isset($user->id)? $user->name : old('name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('address', 'Address Line') }}
                {{ Form::text('address', isset($user->id)? $user->address : old('address'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'email') }}
                {{ Form::text('email', isset($user->id)? $user->email : old('email'), array('class' => 'form-control')) }}
            </div>


            <div class="form-group">
                {{ Form::label('phone', 'Phone') }}
                {{ Form::text('phone', isset($user->id)? $user->phone : old('phone'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Proceed to Payment', array('class' => 'button success')) }}
            {!! Form::close() !!}
        </div>


    </div>


