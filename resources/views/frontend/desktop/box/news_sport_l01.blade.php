<div id="latest_news_video">
    <a href="{{Config::get("app.url")}}sport/tv"><h3 class="title_sport"><img src="{{$fileRepo->getDesktopUrl("img/news_l01.png")}}" alt="المزيد في الشاشة الرياضية" title="المزيد في الشاشة الرياضية"/></h3></a>
    <div id="latest_news_video" class="box_video box_white_video">
        @foreach($newsSportL01 as $article)
            <div class="short_video">
                <div class="short_holder_video">
                    @include("frontend.desktop.box.article_image",[$article,$fileRepo,"width"=>140,"height"=>90,"fnc"=>"getMedium"])
                    <h2 class="article_title_video"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                </div>
            </div>
        @endforeach
        <div class="clearer"> </div>
    </div>
</div>
