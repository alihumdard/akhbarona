@if(count($relatedNews) > 0)
<div id="box_related_news" class="box box_white">
    <h3 class="box_title title_white">{{Config::get("site.lang.LNG_RELATED_NEWS")}}</h3>
    <ul>
        @foreach($relatedNews as $article)
            <li>
                <a href="{{Common::article_link($article)}}">
                    {{$article->title}}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endif
