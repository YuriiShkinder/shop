<div style="width: 80% ;  margin-left: 10%" id="content-page" class="content group ">
    <div class="hentry group">
        @if($category)

            <div id="portfolio" class="portfolio-big-image">

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
                    @if ($articles->lastPage() > 1)
                        <ul class="pagination">

                            @if ($articles->currentPage() !== 1)
                                <a  href="{{ $articles->url(($articles->currentPage()-1)) }}"><img src="{{asset(env('THEME').'/images/icons/for_button/arrow-left.png')}}"></a>
                            @endif
                            @for ($i = 1; $i <= $articles->lastPage(); $i++)

                                @if ($articles->currentPage() == $i)
                                    <a class="selected disabled">{{ $i }}</a>
                                @else
                                    <a href="{{ $articles->url($i) }}">{{ $i }}</a>
                                @endif


                            @endfor

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