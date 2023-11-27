<div id="category_news_box" >
    <div class="main_news_box_row">
        <a href="{{Config::get("app.url")}}sport/articles"><h3 class="title_sport"><img src="{{$fileRepo->getDesktopUrl("img/news_l02.png")}}" alt="المزيد في مقالات رياضية" title="المزيد في مقالات رياضية"/></h3></a>
    </div>
    <div id="latest_news_two" class="box_sport box_white_sport">
        @foreach($newsSportL02 as $article)
            <div class="short_sport_articles">
                <div class="short_holder_sport_articles">
                    @include("frontend.desktop.box.article_image",[$article,$fileRepo,"width"=>120,"height"=>90,"fnc"=>"getMedium"])
                    <h2 class="article_title_sport_articles"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                <div class="clearer"> </div>
                </div>
            </div>
        @endforeach
        <div class="more_sw"><a class="more_sw" href="{{Config::get("app.url")}}sport/articles"></a></div>
        <div class="clearer"> </div>
    </div>
</div>
