<h1>Section 10</h1>
<div class="box1 box_white1">
    <div id="category_news_box" >
        <div class="main_news_box_row">
            <a title="المزيد في ركن المرأة" href="{{Common::mobileLink()}}woman"><h3 class="box_title_wem title_wem">ركن المرأة</h3></a>
        </div>
        <div id="latest_news_two" class="box_two box_white_two">
            @foreach($newsL4 as $article)
                <div class="short">
                    <div class="short_holder">
                        @if($article->image)
                            <div class="image">
                                <a href="{{Common::article_link($article)}}">
                                    <img src="{{$fileRepo->getSummaryLarge($article->image,true,$article->md5_file)}}" width="120" height="90" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                </a>
                            </div>
                        @endif
                        <h2 class="article_title_two_one"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
