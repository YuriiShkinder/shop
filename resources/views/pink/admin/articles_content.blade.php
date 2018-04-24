@if($articles)
    <div id="content-page" class="content group">
        <div class="hentry group">
            <h2>Добавленные статьи</h2>
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th>Заголовок</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Текст</th>
                        <th>Изображение</th>
                        <th>Категория</th>

                        <th>Дествие</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($articles as $article)
                        <tr>
                            <td class="align-left">{{$article->id}}</td>
                            <td class="align-left">{!! Html::link(route('admin.articles.edit',['articles'=>$article->id]),$article->title) !!}</td>
                            <td class="align-left">{{$article->count}}</td>
                            <td class="align-left">{{$article->price}}</td>


                            <td class="align-left">{{str_limit($article->text,200)}}</td>
                            <td>
                                @if(isset($article->img->mini))
                                    {!! Html::image($article->img->mini) !!}
                                @endif
                            </td>
                            <td>
                                @if($article->categories->isNotEmpty())
                                    @foreach($article->categories as $category)
                                         {{$category->title}}
                                    @endforeach

                                    @endif
                            </td>

                            <td>
                                {!! Form::open(['url' => route('admin.articles.destroy',['articles'=>$article->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                                {{ method_field('DELETE') }}
                                {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            {!! HTML::link(route('admin.articles.create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-3']) !!}


        </div>
        <div class="general-pagination group">

            @if( $articles->lastPage() >= 3)
                <ul class="pagination">

                    @if ($articles->currentPage() !== 1)
                        <a  href="{{ $articles->url(($articles->currentPage()-1)) }}"><img src="{{asset(env('THEME').'/images/icons/for_button/arrow-left.png')}}"></a>
                    @endif

                    @if ($articles->currentPage() == 1)
                        <a class="selected disabled">{{ 1 }}</a>
                    @else
                        <a href="{{ $articles->url(1) }}">1</a>
                    @endif

                    <a id="pagination">...</a>


                    @if ($articles->currentPage() == $articles->lastPage())
                        <a class="selected disabled">{{ $articles->lastPage() }}</a>
                    @else
                        <a href="{{ $articles->url( $articles->lastPage()) }}">{{ $articles->lastPage()}}</a>
                    @endif



                    @if ($articles->currentPage() !== $articles->lastPage())

                        <a href="{{ $articles->url($articles->currentPage()+1) }}" ><img src="{{asset(env('THEME').'/images/icons/for_button/arrow.png')}}"></a>
                    @endif

                </ul>
                <ul class="subPagin" >
                    @for ($i = 2; $i < $articles->lastPage(); $i++)

                        @if ($articles->currentPage() == $i)
                            <a class="selected disabled">{{ $i }}</a>
                        @else
                            <a href="{{ $articles->url($i) }}">{{ $i }}</a>
                        @endif

                    @endfor


                </ul>
            @elseif($articles->lastPage() >1 && $articles->lastPage() < 3)

                <ul class="pagination">

                    @if ($articles->currentPage() !== 1)
                        <a  href="{{ $articles->url(($articles->currentPage()-1)) }}"><img src="{{asset(env('THEME').'/images/icons/for_button/arrow-left.png')}}"></a>
                    @endif
                    <ul style="display: none">
                        @for ($i = 1; $i <= $articles->lastPage(); $i++)

                            @if ($articles->currentPage() == $i)
                                <a class="selected disabled">{{ $i }}</a>
                            @else
                                <a href="{{ $articles->url($i) }}">{{ $i }}</a>
                            @endif

                        @endfor

                    </ul>

                    @if ($articles->currentPage() !== $articles->lastPage())

                        <a href="{{ $articles->url($articles->currentPage()+1) }}" ><img src="{{asset(env('THEME').'/images/icons/for_button/arrow.png')}}"></a>
                    @endif

                </ul>

            @endif



        </div>
    </div>
@endif