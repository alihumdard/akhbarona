
<div id="latest_news_video">
    <a title="المزيد في شاشة أخبارنا" href="{{Config::get("app.url")}}videos"><h3 class="box_title title_gray">شاشة
            أخبارنا</h3></a>
    <div id="latest_news_video" class="box_video box_white_video">
        @foreach($newsL1 as $article)
            <div class="short_video">
                <div class="short_holder_video">
                    @if($article->image)
                        <a href="{{Common::article_link($article)}}">

                            <img src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" width="140"
                                 height="90" alt="{{$article->image_caption?$article->image_caption:$article->title}}"/><br/>
                        </a>
                    @endif
                    <h2 class="article_title_video"><a
                            href="{{Common::article_link($article)}}">{{$article->title}}</a>
                    </h2>
                </div>
            </div>
        @endforeach
        <div class="clearer"></div>
    </div>
</div>  