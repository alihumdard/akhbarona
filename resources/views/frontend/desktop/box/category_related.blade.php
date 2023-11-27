@if(count($categoryRelated) > 0)
<div id="box_category_related" class="">
    <h3 class="box_title title_gray">{{Config::get("site.lang.LNG_MORE_FROM")}} {{$article->category_name}}</h3>
    <div class="box_two box_white_two">
        <ul>
            @foreach($categoryRelated as $article)
                <li><a href="{{Common::article_link($article)}}">{{$article->title}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endif

