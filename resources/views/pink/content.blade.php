@if($categories)
    <div id="content-home" class="content group">
        <div class="hentry group">
            <div class="section portfolio">

                <h3 style="text-align: center" class="title">Категории</h3>

                @foreach($categories as $category)



                        <h3 style="margin-top: 30px"><a href=" {{route('categories.show',['alias'=>$category->alias])}}">{{$category->title}}</a></h3>


                @if($articles->isNotEmpty())
                        @foreach($articles->get($category->id) as $article)

                            <div class="portfolio-projects" >
                                <div class="related_project ">
                                    <div class="overlay_a related_img">
                                        <div class="overlay_wrapper">
                                            <img style="width: 200px" src="{{$article->img->max}}" alt="{{$article->title}}" title="{{$article->title}}" />
                                            <h5>price {{$article->price}}$</h5>
                                        </div>
                                    </div>
                                    <h4><a href="{{route('articles.show',['article'=>$article->id])}}">{{$article->title}}</a></h4>
                                    <p> {{str_limit($article->desc,100)}}</p>
                                </div>
                            </div>

                         @endforeach
                            <div class="clear"></div>

                    @if($sales->has($category->id))
                                @foreach($sales->get($category->id) as $sale)

                                    <div class="portfolio-projects" >
                                        <div class="related_project ">
                                            <div class="overlay_a related_img">
                                                <div class="overlay_wrapper ">
                                                    <div class="saleArt" style="background: url({{env('THEME').'/images/sale.png' }}) no-repeat center center;background-size: 80px; "></div>
                                                    <img style="width: 200px" src="{{json_decode($sale->article->img)->max}}" alt="{{$sale->title}}" title="{{$sale->title}}" />
                                                    <h5>price {{$sale->article->price}}$</h5>
                                                    <h5>sale price {{$sale->article->price-$sale->sale}}$</h5>
                                                </div>
                                            </div>
                                            <h4><a href="{{route('articles.show',['article'=>$sale->article->id])}}">{{$sale->article->title}}</a></h4>
                                            <p> {{str_limit($sale->article->desc,100)}}</p>
                                        </div>
                                    </div>

                                @endforeach
                        @else
                                <h5>Нет акионых товаров категории: {{$category->title}}</h5>
                    @endif
                    @else
                        <h5>Нет товара категории: {{$category->title}}</h5>

                 @endif
                    <div class="clear"></div>
                    @endforeach

            </div>
            <div class="clear"></div>
        </div>
        <!-- START COMMENTS -->
        <div id="comments">
        </div>
        <!-- END COMMENTS -->
    </div>
    <!-- START SIDEBAR -->

    <div class="sidebar group">
        <div class="widget-first widget recent-posts">
            <h3>Tоп-5 популярных (наиболее
                комментируемых) товаров</h3>
            <div class="recent-post group">
                @if($comments)
                    @foreach($comments as $comment)
                        <div class="hentry-post group">
                            <div class="thumb-img"><a href="{{route('articles.show',['article'=>$comment->get('article')->id])}}"><img src="{{json_decode($comment->get('article')->img)->mini}}" alt="{{$comment->get('article')->title}}" title="{{$comment->get('article')->title}}" /></a></div>
                            <div class="text">
                                <p class="title">{{str_limit($comment->get('article')->text,50)}}</p>
                                <p class="post-date"> {{is_object($comment->get('article')->created_at) ? $comment->get('article')->created_at->format('F d, Y  \a\t H:i') : '' }} </p>
                                <p><span><img style="width: 10px" src="{{asset(env('THEME')).'/images/icons/chat.png'}}"> </span>{{$comment->get('total')}} коментария</p>
                            </div>
                        </div>

                    @endforeach
                 @endif


            </div>


        </div>

        <!-- END SIDEBAR -->
        <!-- START EXTRA CONTENT -->
        <!-- END EXTRA CONTENT -->
    </div>
    </div>
    <!-- END PRIMARY -->
@endif
