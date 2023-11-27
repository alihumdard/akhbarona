<div id="headline">
    <div id="rotating_headlines" class="box_headline">
        <div class="player">
            <ul id="rotating_headlines_player">
                @foreach($sportHeadlines as $index=>$article)
                    <li><a href="#rotating_headlines_{{$index}}">{{$article->title}}</a></li>
                @endforeach
            </ul>
        </div>
        @foreach($sportHeadlines as $index=>$article)
            <div class="headline_article">
                <div id="rotating_headlines_{{$index}}" class="headline_article_holder" @if($index != 0) style="display:none;" @endif>
                    @if($article->image)
                        <div class="headline_image">
                            <a href="{{Common::article_link($article)}}"><img src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="380" height="341" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /></a>
                            <div id="rotating_headlines_article_{{$index}}" class="image_caption">
                                {{$article->abstract?$article->abstract:Common::subWords($article->body,25)}}...
                                <a class="headline_link" href="{{Common::article_link($article)}}">{{Config::get("site.lang.LNG_FULL_STORY")}}</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
<script type="text/javascript">
    var rotating_headlines_tabs = new vivvoRotatingHeadlines('rotating_headlines', {{isset($setting["VIVVO_MODULES_HEADLINES_ROTATION_TIME"])?$setting["VIVVO_MODULES_HEADLINES_ROTATION_TIME"]:8}});
</script>
