<div id="box_category_related" class="">
    <h3 class="box_title title_gray">آخر الأخبار</h3>
    <div class="box_two box_white_two">
        <ul>
            @foreach($latestNewsSw as $article)
                <li><a href="{{Common::article_link($article)}}">{{$article->title}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
