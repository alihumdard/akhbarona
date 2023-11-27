<div id="category_news_box" >
    <div id="latest_news_social" class="box_social box_white_social">
    <a title="المزيد في قضايا المجتمع" href="{{Common::mobileLink()}}social"><h3 class="box_title_social title_social">قضايا المجتمع</h3></a>
        <ul>
            @foreach($newsR04n as $article)
                <div class="short_social">
                    <div class="short_holder_social">
                        @if($article->image)
                            <div class="image">
                                <a href="{{Common::article_link($article)}}">
                                    <img src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="191" height="140" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                </a>
                            </div>
                        @endif
                    <div class="clearer"> </div>
                        <h2 class="article_title_social"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                    </div>
                </div>
            @endforeach
            <div class="more_sw"><a class="more_sw" href="{{Common::mobileLink()}}social"></a></div>
            <div class="clearer"> </div>
        </ul>
    </div>
</div>

