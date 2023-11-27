<div class="box1 box_white1">
    <div id="category_news_box" >
        <div class="main_news_box_row">
        <a href="{{Config::get("app.url")}}sport/proplayers"><h3 class="box_"><img width="650" src="{{$fileRepo->getDesktopUrl("img/news_r03.png")}}" alt="المزيد في مرصد المحترفين" title="المزيد في مرصد المحترفين"/></h3></a>
        </div>
        <div id="latest_news_two" class="box_sport box_white_sport">
            @if(count($newsSportR03) > 0)
                <ul>
                    <?php $article = $newsSportR03[0];unset($newsSportR03[0]);?>
                    <div class="short_sport_one_b">
                        <div class="short_holder_sport_one_b">
                            @include("frontend.desktop.box.article_image",[$article,$fileRepo,"width"=>250,"height"=>190,"fnc"=>"getLarge"])
                            <div class="clearer"> </div>
                            <h2 class="article_title_sport_one_b"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                            @include("frontend.desktop.box.article_external",[$article,$fileRepo])
                        </div>
                    </div>
                    @foreach($newsSportR03 as $article)
                        <div class="short_sport_b">
                            <div class="short_holder_sport_b">
                                @include("frontend.desktop.box.article_image",[$article,$fileRepo,"width"=>100,"height"=>80,"fnc"=>"getMedium"])
                                <h2 class="article_title_sport_b"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                                <div class="clearer"> </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="more_sw"><a class="more_sw" href="{{Config::get("app.url")}}sport/proplayers"></a></div>
                    <div class="clearer"> </div>
                </ul>
            @endif
        </div>
    </div>
</div>
