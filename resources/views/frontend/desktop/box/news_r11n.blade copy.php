<div id="category_news_box" >
    <div class="main_news_box_row">
    <a title="المزيد في ثقافة وفنون" href="{{Common::mobileLink()}}culture"><h3 class="box_title_two_art title_two_art">ثقافة وفنون</h3></a>
    </div>
    <div id="latest_news_two" class="box_two box_white_two">
        <ul>
            @foreach($newsR11n as $article)
                <div class="short_social">
                    <div class="short_holder_social">
                        @if($article->image)
                            <div class="image">
                                <a href="{{Common::article_link($article)}}">
                                    <img src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" width="191" height="140" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                </a>
                            </div>
                        @endif
                    <div class="clearer"> </div>
                        <h2 class="article_title_social"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                    </div>
                </div>
            @endforeach
            <div class="clearer"> </div>
        </ul>
    </div>
</div>
