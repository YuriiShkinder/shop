


<div id="content-page" class="content group">
    <div class="hentry group">

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
        {!! Form::open(['url' =>  route('userEdit',['user'=>$user->login]),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ведите имя:</span>
                    <br />
                    <span class="sublabel">Ваше имя</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('name', $user->name , ['placeholder'=>'Введите ваше имя']) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ведите login:</span>
                    <br />
                    <span class="sublabel">Ваш login</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('login', $user->login , ['placeholder'=>'Введите ваш login']) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ведите email:</span>
                    <br />
                    <span class="sublabel">Ваш email</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('email',$user->email , ['placeholder'=>'Введите ваш email']) !!}
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ведите address:</span>
                    <br />
                    <span class="sublabel">Ваш address</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('address',$user->address , ['placeholder'=>'Введите ваш address']) !!}
                </div>
            </li>


            @if(isset($user->img))
                <li class="textarea-field">

                    <label>
                        <span class="label">Ваше  изображения :</span>
                    </label>

                    {{ Html::image($user->img,'',['style'=>'width:400px']) }}
                    {!! Form::hidden('old_image',$user->img) !!}

                </li>
            @endif


            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ваше  изображения :</span>
                    <br />
                    <span class="sublabel">Ваше  изображения  </span><br />
                </label>
                <div class="input-prepend">
                    {!! Form::file('img', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
                </div>

            </li>

            <li class="submit-button">
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
            </li>

        </ul>

        {!! Form::close() !!}

    </div>
</div>