@if(count($newsR12n) > 0)
    <div class="box1 box_white1">
    <div id="category_news_box" >
        <div class="main_news_box_row">
        <a title="المزيد في الأخيرة" href="{{Common::mobileLink()}}last"><h3 class="box_title_two title_two">الأخيرة</h3></a>
        </div>
        <div id="latest_news_two" class="box_two box_white_two">
            <ul>
                <?php $article = $newsR12n[0];unset($newsR12n[0])?>
                    <div class="short_two_one">
                        <div class="short_holder_two_one">
                            @if($article->image)
                                <div class="image">
                                    <a href="{{Common::article_link($article)}}">
                                        <img src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" width="250" height="200" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                    </a>
                                </div>
                            @endif
                            <div class="clearer"> </div>
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
                @foreach($newsR12n as $article)
                    <div class="short_two">
                        <div class="short_holder_two">
                            @if($article->image)
                                <div class="image">
                                    <a href="{{Common::article_link($article)}}">
                                        <img src="{{$fileRepo->getSummaryLarge($article->image,true,$article->md5_file)}}" width="161" height="110" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                    </a>
                                </div>
                            @endif
                        <div class="clearer"> </div>
                            <h2 class="article_title_two"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                        </div>
                    </div>
                @endforeach
                <div class="clearer"> </div>
            </ul>
        </div>
    </div>
</div>
@endif
