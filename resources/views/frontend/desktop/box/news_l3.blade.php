<h1>Section 9</h1>
<div class="box1 box_white1">
    <div id="category_news_box" >
        <div class="main_news_box_row">
            <a title="المزيد في نداءات إنسانية" href="{{Common::mobileLink()}}problems"><h3 class="box_title_problem title_problem">نداءات إنسانية</h3></a>
        </div>
        <div id="latest_news_two" class="box_two box_white_two">
                @foreach($newsL3 as $article)
                    <h2 class="article_title_two_one"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                    <div class="short">
                        <div class="short_holder">
                            @if($article->image)
                                <div class="image">
                                    <a href="{{Common::article_link($article)}}">
                                        <img src="{{$fileRepo->getSummaryMedium($article->image,true,$article->md5_file)}}" width="100" height="90" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                    </a>
                                </div>
                            @endif
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
                    </div>
                @endforeach
        </div>
    </div>
</div>
