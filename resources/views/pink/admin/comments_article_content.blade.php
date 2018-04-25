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
                        <th>Количество комментариев</th>
                        <th>Категории</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($articles as $article)
                        <tr>
                            <td class="align-left">{{$article->id}}</td>
                            @if($article->comments->count()>0)
                            <td class="align-left">{!! Html::link(route('showComments',['article'=>$article->id]),$article->title) !!}</td>
                            @else
                                <td class="align-left">{!!$article->title !!}</td>

                            @endif
                                <td class="align-left">{{$article->comments->count()}}</td>
                            <td>
                                @if($article->categories->isNotEmpty())
                                    @foreach($article->categories as $category)
                                        {{$category->title}}
                                    @endforeach

                                @endif
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>


        </div>
        <div class="general-pagination group">

            @if( $articles->lastPage() >= 3)
                <ul class="pagination">

                    @if ($articles->currentPage() !== 1)
                        <a  href="{{ $articles->url(($articles->currentPage()-1)) }}"><img src="{{asset('pink'.'/images/icons/for_button/arrow-left.png')}}"></a>
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

                        <a href="{{ $articles->url($articles->currentPage()+1) }}" ><img src="{{asset('pink'.'/images/icons/for_button/arrow.png')}}"></a>
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
                        <a  href="{{ $articles->url(($articles->currentPage()-1)) }}"><img src="{{asset('pink'.'/images/icons/for_button/arrow-left.png')}}"></a>
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

                        <a href="{{ $articles->url($articles->currentPage()+1) }}" ><img src="{{asset('pink'.'/images/icons/for_button/arrow.png')}}"></a>
                    @endif

                </ul>

            @endif



        </div>
    </div>
@endif