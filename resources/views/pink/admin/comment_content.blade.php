<div id="content-page" class="content group">
    <div class="hentry group">

        @foreach($article->comments as $comment)

        {!! Form::open(['url' => route('showComments',['article'=>$article->id]),'class'=>'contact-form','method'=>'POST']) !!}

        <input type="hidden" name="id" value="{{$comment->id}}">

             <p>Name user -{{$comment->user->name}}</p>

                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::textarea('text',$comment->text, ['placeholder'=>'Введите коментарии']) !!}
                </div>

                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}


        {!! Form::close() !!}

      @endforeach
    </div>
</div>