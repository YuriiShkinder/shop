<ul style="position: absolute; top: 30px; width: 200px"  >
<span style="text-decoration:underline">Поиск по категориям</span>

@if($categories->isNotEmpty())
        @foreach($categories as $category)
            <li>
               {!! Html::link(route('categories.show',['alias'=>$category->alias]),$category->title,['class' => 'btn btn-the-salmon-dance-2']) !!}
            </li>
        @endforeach
@else
        <li style="padding: 0!important;">
            Нечего не найдено
        </li>

    @endif
    <span style="text-decoration:underline">Поиск по товарам</span>
    @if($articles->isNotEmpty())
        @foreach($articles as $article)
            <li>
                {!! Html::link(route('articles.show',['article'=>$article->id]),$article->title,['class' => 'btn btn-the-salmon-dance-2']) !!}
            </li>
        @endforeach
    @else
        <li style="padding: 0!important;">
            Нечего не найдено
        </li>

    @endif



</ul>