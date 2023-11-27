<div class="box1 box_white1">
    <div id="category_news_box" >
        <div class="main_news_box_row">
        <a href="{{Config::get("app.url")}}events"><h3 class="title_sport"><img width="650" src="{{$fileRepo->getDesktopUrl("img/news_r01.png")}}" alt="المزيد في أخبار أخرى" title="المزيد في أخبار أخرى"/></h3></a>
        </div>
        @if(count($newsSportR01) > 0)
        <div id="latest_news_two" class="box_sport box_white_sport">
            <ul>
                <?php $article = $newsSportR01[0];unset($newsSportR01[0]);?>
                <div class="short_sport">
                    <div class="short_holder_sport">
                        @include("frontend.desktop.box.article_image",[$article,$fileRepo,"width"=>190,"height"=>125,"fnc"=>"getMedium"])
                        <div class="clearer"> </div>
                        <h2 class="article_title_sport"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                        @include("frontend.desktop.box.article_external",[$article,$fileRepo])
                    </div>
                </div>
                @foreach($newsSportR01 as $article)
                    <div class="short_sport">
                        <div class="short_holder_sport">
                            @include("frontend.desktop.box.article_image",[$article,$fileRepo,"width"=>190,"height"=>125,"fnc"=>"getMedium"])
                        <div class="clearer"> </div>
                            <h2 class="article_title_sport"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                        </div>
                    </div>
                @endforeach
                <div class="clearer"> </div>
            </ul>
        </div>
        @endif
    </div>
</div>
