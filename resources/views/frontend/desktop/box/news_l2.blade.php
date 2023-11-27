<h1>Section 8</h1>
<div class="white_box">
    <div class="white_box_top"><!--fds--></div>
    <div class="white_box_mid">
        <a title="المزيد في أقلام حرة" href="{{Common::mobileLink()}}writers"><h3 class="box_title title_gray">أقلام حرة</h3></a>
        <div class="box box_white">
            <div id="mainTicker" class="ticker_summary_sw">
                <div style="overflow:hidden;" class="scroller">
                    @foreach($newsL2 as $index=>$article)
                        <div id="ticker_{{$article->id}}" class="section row_{{$index%2}}">
                            @if($article->image)
                                <div class="image">
                                    <a href="{{Common::article_link($article)}}">
                                        <img src="{{$fileRepo->getSummaryMedium($article->image,true,$article->md5_file)}}" width="50" height="65" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                    </a>
                                </div>
                            @endif
                            <h3><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h3>
                            <div class="story_stamp_sw">
                                @if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR"])
                                    <span class="story_author_sw">{{$article->author}}</span>
                                @endif
                            </div>
                            <div class="clearer"> </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="white_box_bottom"><!--fds--></div>
</div>
