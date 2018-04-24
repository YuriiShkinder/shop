<div style="width: 80% ;  margin-left: 10%" id="content-page" class="content group ">
    <div class="hentry group">

            @if($category)
            <div id="portfolio" class="portfolio-big-image">
                @if(isset($category->down) && $category->down->isNotEmpty())
                    <h3>Подкатегории</h3>
                    @foreach($category->down as $down)

                        {!! Html::link(route('down',['categories'=>$category->alias,'down'=>$down->alias]),$down->title,['class' => 'btn btn-the-salmon-dance-3','style'=>'padding:5px 20px;margin:20px 0']) !!}

                        @endforeach

                    @endif
                    <h3>Toвары</h3>
                @foreach($articles as $article)

                    <div class="hentry work group">
                        <div class="work-thumbnail">
                            <div class="nozoom">
                                <img src="{{  $article->img->max }}" alt="{{$article->title}}" title="{{$article->title}}" />

                            </div>
                        </div>
                        <div class="work-description">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ str_limit($article->text,200) }}</p>
                            <div class="clear"></div>
                            <div class="work-skillsdate">
                                <p class="skills"><span class="label">category:</span> {{$category->title}}</p>
                                <p class="skills"><span class="label">price:</span> {{$article->price}}</p>


                                @if($article->created_at)
                                    <p class="workdate"><span class="label">Year:</span>{{$article->created_at->format('Y')}}</p>

                                @endif

                            </div>
                            <a class="read-more" href="{{ route('articles.show',['article' => $article->id]) }}">View Project</a>
                        </div>
                        <div class="clear"></div>
                    </div>

                @endforeach


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
        <div class="clear"></div>
    </div>
    <!-- START COMMENTS -->
    <div id="comments">
    </div>
    <!-- END COMMENTS -->
</div>