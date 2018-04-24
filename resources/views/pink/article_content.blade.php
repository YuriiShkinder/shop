<div id="content-single" class="content group">

@if($article)

    <div class="hentry hentry-post blog-big group ">
        <!-- post featured & title -->

        <div class="thumbnail">
            <!-- post title -->
            <h1 class="post-title"><a href="#">{{$article->title}}</a></h1>
            <!-- post featured -->
            <div class="image-wrap">
                <img src="{{$article->img->max}}" alt="{{$article->title}}" title="{{$article->title}}" />
            </div>
            <p class="date">
                <span class="month">{{$article->created_at->format('M')}}</span>
                <span class="day">{{$article->created_at->format('d')}}</span>
            </p>
        </div>
        <!-- post meta -->
        <div class="meta group">
            <p class="categories"><span>  price {{$article->price}} $ {!! Html::link('#','В корзину',['id'=>$article->id,'class' => 'btn btn-the-salmon-dance-3 cartOrder ','style'=>'padding:5px 20px;','url'=>route('cart')]) !!}</span></p>
            <p class="comments "><span><a href="#comments" title="Comment on This is the title of the first article. Enjoy it.">{{count($article->comments) ? count($article->comments) : 0}}Comments</a></span></p>

        </div>
        <!-- post content -->
        <div class="the-content single group">
        <p>
            {!! $article->text!!}
        </p>
            <div class="socials">
                <h2>love it, share it!</h2>
                <a href="https://www.facebook.com/sharer.html?u=http%3A%2F%2Fyourinspirationtheme.com%2Fdemo%2Fpinkrio%2F2012%2F09%2F24%2Fthis-is-the-title-of-the-first-article-enjoy-it%2F&amp;t=This+is+the+title+of+the+first+article.+Enjoy+it." class="socials-small facebook-small" title="Facebook">facebook</a>
                <a href="https://twitter.com/share?url=http%3A%2F%2Fyourinspirationtheme.com%2Fdemo%2Fpinkrio%2F2012%2F09%2F24%2Fthis-is-the-title-of-the-first-article-enjoy-it%2F&amp;text=This+is+the+title+of+the+first+article.+Enjoy+it." class="socials-small twitter-small" title="Twitter">twitter</a>
                <a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http%3A%2F%2Fyourinspirationtheme.com%2Fdemo%2Fpinkrio%2F2012%2F09%2F24%2Fthis-is-the-title-of-the-first-article-enjoy-it%2F&amp;title=This+is+the+title+of+the+first+article.+Enjoy+it." class="socials-small google-small" title="Google">google</a>
                <a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fyourinspirationtheme.com%2Fdemo%2Fpinkrio%2F2012%2F09%2F24%2Fthis-is-the-title-of-the-first-article-enjoy-it%2F&amp;media=http://yourinspirationtheme.com/demo/pinkrio/files/2012/09/00212.jpg&amp;description=Fusce+nec+accumsan+eros.+Aenean+ac+orci+a+magna+vestibulum+posuere+quis+nec+nisi.+Maecenas+rutrum+vehicula+condimentum.+Donec+volutpat+nisl+ac+mauris+consectetur+gravida.+Lorem+ipsum+dolor+sit+amet%2C+consectetur+adipiscing+elit.+Donec+vel+vulputate+nibh.+Pellentesque%5B...%5D" class="socials-small pinterest-small" title="Pinterest">pinterest</a>
                <a href="http://yourinspirationtheme.com/demo/pinkrio/2012/09/24/this-is-the-title-of-the-first-article-enjoy-it/" class="socials-small bookmark-small" title="This is the title of the first article. Enjoy it.">bookmark</a>
            </div>
        </div>
        <p class="tags">Tags: <a href="#" rel="tag">book</a>, <a href="#" rel="tag">css</a>, <a href="#" rel="tag">design</a>, <a href="#" rel="tag">inspiration</a></p>
        <div class="clear"></div>
    </div>
    @auth
    <!-- START COMMENTS -->
    <div id="comments">
        <h3 id="comments-title">
            <span>{{count($article->comments)}}</span> comments
        </h3>
        <div style="text-align: right" >
        <a class="btn btn-black" href="{{route('filterComent',['article'=>$article->id,'filter'=>'1'])}}">
            Рекомендую
        </a>
        <a class="btn btn-black" href="{{route('filterComent',['article'=>$article->id,'filter'=>'0'])}}">
            Не рекомендую
        </a>
            @if(isset($filter))
            <a class="btn btn-black" href="{{route('articles.show',['article'=>$article->id])}}">
                Сбросить фильтр
            </a>
                @endif
        </div>
        @if(isset($comments) && count($comments)> 0)


@set($com,$comments)
        <ol class="commentlist group">
            @foreach($comments as $k=>$comment)
                @if($k!==0)
                    @break
                @endif
                @include(env('THEME').'.comment',['items'=>$comment])
            @endforeach

        </ol>
            @else
            <ol class="commentlist group">

            </ol>

         @endif

        <!-- START TRACKBACK & PINGBACK -->
        <h2 id="trackbacks">Trackbacks and pingbacks</h2>
        <ol class="trackbacklist"></ol>
        <p><em>No trackback or pingback available for this article.</em></p>

        <!-- END TRACKBACK & PINGBACK -->
        <div id="respond">
            <h3 id="reply-title">Leave a <span>Reply</span> <small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Cancel reply</a></small></h3>
            <form action="{{route('comment.store')}}" method="post" id="commentform">

                <p class="comment-form-comment"><label for="comment">Your comment</label><textarea id="comment" name="text" cols="45" rows="8"></textarea></p>
                <div class="clear"></div>
                <p class="form-submit">
                    <input type="hidden" name="comment_post_ID" value="{{$article->id}}" id="comment_post_ID">
                    <input id="comment_parent" type="hidden" name="comment_parent" value="0">
                    {{csrf_field()}}

                <div class="form-check-input" >
                    <input checked type="checkbox" class="form-check-input" id="exampleCheck1" name="prompt">
                    <label class="form-check-label" for="exampleCheck1">Рекомендую</label>
                </div>
                    <input name="submit" type="submit" id="submit" value="Post Comment" />
                </p>


            </form>

        </div>
        <!-- #respond -->
    </div>
        @else
        {!! Html::link(route('login'),'Авторезуйтесь для просмотра комментариев',['class' => 'btn btn-the-salmon-dance-3 ','style'=>'padding:5px 20px;']) !!}

        @endcan
    @endif
    <!-- END COMMENTS -->
</div>