@if($categories)
    <div id="content-home" class="content group">
        <div class="hentry group">
            <div class="section portfolio">

                <h3 style="text-align: center" class="title">Категории</h3>

                @foreach($categories as $category)



                        <h3><a href="http://pink/portfolios/project1">{{$category->title}}</a></h3>


                @if($category->articles->count()>=3)
                        @foreach($category->articles->random(3) as $article)
                            <div class="portfolio-projects" >
                                <div class="related_project ">
                                    <div class="overlay_a related_img">
                                        <div class="overlay_wrapper">
                                            <img style="width: 200px" src="{{$article->img->max}}" alt="{{$article->title}}" title="{{$article->title}}" />
                                            <h5>price {{$article->price}}$</h5>
                                        </div>
                                    </div>
                                    <h4><a href="http://pink/portfolios/project2">{{$article->title}}</a></h4>
                                    <p> {{str_limit($article->desc,200)}}</p>
                                </div>


                            </div>

                         @endforeach


                            <div class="clear"></div>
                    @else
                        <h3>Нет товара категории: {{$category->title}}</h3>

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
            <h3>Последние записи блога</h3>
            <div class="recent-post group">
                <div class="hentry-post group">
                    <div class="thumb-img"><img src="http://pink/pink/images/articles/003-55x55.jpg " alt="003" title="003" /></div>
                    <div class="text">
                        <a href="http://pink/articles/privet" title="Nice &amp; Clean. The best for your blog!" class="title">This is the title of the first article. Enjoy it</a>
                        <p class="post-date">July 17, 2016 </p>
                    </div>
                </div>

                <div class="hentry-post group">
                    <div class="thumb-img"><img src="http://pink/pink/images/articles/001-55x55.png " alt="003" title="003" /></div>
                    <div class="text">
                        <a href="http://pink/articles/article-2" title="Nice &amp; Clean. The best for your blog!" class="title">Nice &amp; Clean. The best for your blog!
                        </a>
                        <p class="post-date">July 16, 2016 </p>
                    </div>
                </div>

                <div class="hentry-post group">
                    <div class="thumb-img"><img src="http://pink/pink/images/articles/0037-55x55.jpg " alt="003" title="003" /></div>
                    <div class="text">
                        <a href="http://pink/articles/article-3" title="Nice &amp; Clean. The best for your blog!" class="title">Section shortcodes &amp; sticky posts!
                        </a>
                        <p class="post-date">July 16, 2016 </p>
                    </div>
                </div>


            </div>



            <div class="widget-last widget text-image">
                <h3>Customer support</h3>
                <div class="text-image" style="text-align:left"><img src="http://pink/pink/images/callus.gif" alt="Customer support" /></div>
                <p>Proin porttitor dolor eu nibh lacinia at ultrices lorem venenatis. Sed volutpat scelerisque vulputate. </p>
            </div>



        </div>

        <!-- END SIDEBAR -->
        <!-- START EXTRA CONTENT -->
        <!-- END EXTRA CONTENT -->
    </div>
    </div>
    <!-- END PRIMARY -->
@endif
