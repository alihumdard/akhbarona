<div id="category_news_box" >
    <div class="main_news_box_row">
        <a title="المزيد في أخبار وطنية" href="{{Common::mobileLink()}}national"><h3 class="box_title_policy title_policy">أخبار وطنية</h3></a>
    </div>
    <div id="latest_news_bh_sw_container">
        @foreach($newsR01n as $article)
            <div class="latest_news_bh_sw_toggle">
                <h2><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
            </div>
        @endforeach
    </div>
</div>
