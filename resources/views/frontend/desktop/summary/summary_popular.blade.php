<div class="short">
    <div class="short_holder">
        @if($article->image)
            <div class="image">
                <a href="{{Common::article_link($article)}}">
                    <img src="{{$fileRepo->getSummaryMedium($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" height="70" width="100" /><br />
                </a>
            </div>
        @endif
        <h2 class="article_title" style="font-size: 14px; height: 70px; text-align: right;padding-left: 15px;"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
        <div style="float: left;margin-left: 15px;margin-top: -6px;">
            @if($article->today_read > 0)
                <div style="float:right;padding-top: 2px;color: grey;">&nbsp;&nbsp;{{$article->today_read}}</div>
            @endif
            <div style="float: left;padding-right: 4px;"><img src="{{$fileRepo->getDesktopUrl("img/eye-icon.png")}}" style="opacity: 0.3;width: 20px;height: 20px;"></div></div>


    </div>
</div>
