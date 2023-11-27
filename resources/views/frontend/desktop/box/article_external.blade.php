<p>
    {{$article->abstract?$article->abstract:Common::subWords($article->body,25)}} @if($article->body)...@endif
    @if(!$article->link)
        @if($article->body)
            <span class="mor_full"><a href="{{Common::article_link($article)}}"> {{Config::get("site.lang.LNG_FULL_STORY")}}</a></span>
        @endif
    @else
        <a class="visit" href="{{$article->link}}"><img src="{{$fileRepo->getDesktopUrl("img/external.png")}}" alt="{{Config::get("site.lang.LNG_VISIT_WEBSITE")}}"/></a>
    @endif
</p>
