<h3 class="box_title_bh_sw title_white_bh_sw">آخر الأخبار</h3>
<div id="latest_news_bh_sw_container">
    @foreach($latestNewsBhSw as $article)
        <div class="latest_news_bh_sw_toggle" style="height: 54px;">
            <h4>@include("frontend.desktop.box.latest_news_bh_date",[$article])<a href="{{Common::article_link($article)}}">{{$article->title}}</a></h4>
        </div>
    @endforeach
</div> 



  

  