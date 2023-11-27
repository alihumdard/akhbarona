<div class="box1 box_white1">
    <div id="category_news_box" >
        <div class="main_news_box_row">
            <a title="المزيد في مباريات ووظائف" href="{{Common::mobileLink()}}contest"><h3 class="box_title_contest title_contest">مباريات ووظائف</h3></a>
        </div>
        <div id="latest_news_two" class="box_two box_white_two">
                @foreach($newsL8 as $article)
                    <div class="short">
                        <div class="short_holder">
                            @if($article->image)
                                <div class="image">
                                    <a href="{{Common::article_link($article)}}">
                                        <img src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="150" height="110" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                    </a>
                                </div>
                            @endif
                            <h2 class="article_title_two_one"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                        </div>
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
                    </div>
                @endforeach
        </div>
    </div>
</div>
