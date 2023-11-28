<h1>Section 2111</h1>
<div id="headline">
    <div id="rotating_headlines" class="box_headline">
        @foreach($fancyHeadlines as $index=>$article)
            <div id="rotating_headlines_{{$index}}" class="headline_article_holder" style="{{$index != 0?"display:none;":""}}">

                <div class="headline_image">
                    @if($article->image)
                        <div id="headline_image_big">
                            <a href="{{Common::article_link($article)}}">

                                <img id="defaultDemo" src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="460" height="312" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                            </a>
                        </div>
                    @endif
                    <div id="rotating_headlines_article_{{$index}}" class="headline_short">
                        <h1 class="article_title_fancy"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h1>
                        {{$article->abstract?$article->abstract:Common::subWords($article->body,25)}}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="player">
            <ul id="rotating_headlines_player">
                @foreach($fancyHeadlines as $index=>$article)
                    <li>
                        <a href="#rotating_headlines_{{$index}}">
                            <img src="{{$fileRepo->getSmall($article->image,true,$article->md5_file)}}" width="45" height="45" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="clearer"> </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var rotating_headlines_tabs = new vivvoRotatingHeadlines('rotating_headlines', {{isset($setting["VIVVO_MODULES_HEADLINES_ROTATION_TIME"])?$setting["VIVVO_MODULES_HEADLINES_ROTATION_TIME"]:8}});
</script>
