@if(count($newsR09n) > 0)
<div id="category_news_box" >
    <div class="main_news_box_row">
        <a title="المزيد في طب وصحة" href="{{Common::mobileLink()}}health"><h3 class="box_title_two title_two">طب وصحة</h3></a>
    </div>
    <div id="latest_news_two" class="box_two box_white_two">
        <?php $article = $newsR09n[0];unset($newsR09n[0])?>
            <div class="short">
                <div class="short_holder">
                    @if($article->image)
                        <div class="image">
                            <a href="{{Common::article_link($article)}}">
                                <img src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" width="305" height="200" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                            </a>
                        </div>
                    @endif
                </div>
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
        <ul>
            @foreach($newsR09n as $article)
                <li>
                    <a href="{{Common::article_link($article)}}">
                        {{$article->title}}
                    </a>
                </li>
            @endforeach
            <div class="more_sw"><a class="more_sw" href="{{Common::mobileLink()}}health"></a></div>
            <div class="clearer"> </div>
        </ul>
    </div>
</div>
@endif
