@if(count($latestNewsArtSw) > 0)
    <div id="box_category_related" class="box box_white">
        <h3 class="box_title title_white">آخر الأخبار</h3>
        <ul>
            @foreach($latestNewsArtSw as $article)
                <li><a href="{{Common::article_link($article)}}">{{$article->title}}</a></li>
            @endforeach
        </ul>
    </div>
@endif
