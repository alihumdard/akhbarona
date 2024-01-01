<div class="short">
    <div class="short_holder">
        @if($article->image)
            <div class="image">
                <a href="{{Common::article_link($article)}}">
                    <img src="{{$fileRepo->getSummaryMedium($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                </a>
            </div>
        @endif
        <h2 class="article_title"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
        <p>
            {{$article->abstract?$article->abstract:Common::subWords($article->body,25)}} @if($article->body)...@endif
            @if(!$article->link)
                @if($article->body)
                    <a href="{{Common::article_link($article)}}"> {{Config::get("site.lang.LNG_FULL_STORY")}}</a>
                @endif
            @else
                <a class="visit" href="{{$article->link}}"><img src="{{$fileRepo->getDesktopUrl("img/external.png")}}" alt="{{Config::get("site.lang.LNG_VISIT_WEBSITE")}}"/></a>
            @endif
        </p>
    </div>
</div>
