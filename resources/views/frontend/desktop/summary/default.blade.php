<div class="col-12 col-sm-12 col-md-6 mt-3 col-lg-3 mt-3">
    <a class="news-links" href="detail-page.html">
        <div class="main-box">
            @if($article->image)
            <a href="{{Common::article_link($article)}}">
                <img class="img-fluid" src="{{$fileRepo->getSummaryMedium($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
            </a>
            @endif
            <div class="main-box-text">
                <p><a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                <p>
                    <!-- {{$article->abstract?$article->abstract:Common::subWords($article->body,25)}} @if($article->body)...@endif
                    @if(!$article->link)
                        @if($article->body)
                            <a href="{{Common::article_link($article)}}"> {{Config::get("site.lang.LNG_FULL_STORY")}}</a>
                        @endif
                    @else
                        <a class="visit" href="{{$article->link}}"><img src="{{$fileRepo->getDesktopUrl("img/external.png")}}" alt="{{Config::get("site.lang.LNG_VISIT_WEBSITE")}}"/></a>
                    @endif -->
                </p>
            </div>
        </div>
    </a>
</div>