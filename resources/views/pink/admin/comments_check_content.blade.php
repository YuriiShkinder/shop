@if($comments->isNotEmpty())
    <h3>
        Коментарии с пометкой не рекомендую
    </h3>
<div id="content-page" class="content group">
    <div class="hentry group">

        @foreach($comments as $comment)

            {!! Form::open(['url' => route('checkComments'),'class'=>'contact-form','method'=>'POST']) !!}

            <input type="hidden" name="id" value="{{$comment->id}}">

            <p>Name user -{{$comment->user->name}}</p>

            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::textarea('text',$comment->text, ['placeholder'=>'Введите коментарии']) !!}
            </div>

        <input type="checkbox" name="view">Отобразить

            {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
            {!! Form::close() !!}

        @endforeach
    </div>
</div>
    @endif