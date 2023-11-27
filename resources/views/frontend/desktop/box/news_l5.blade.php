<div class="">
    <div class="box">
        <div class="main_news_box_row">
            <a title="المزيد في كاريكاتير وصورة" href="{{Common::mobileLink()}}caricature"><h3 class="box_title_two title_two">كاريكاتير وصورة</h3></a>
        </div>
        <div id="latest_news_two" class="box_caric box_white_caric">
            <div class="box_content">
                <div id="article_category_stripe">
                    <div id="article_category_stripe_stripe_body" style="width:100%; overflow:hidden;">
                        <div class="scroller">
                            <div class="content">
                                @foreach($newsL5 as $index=>$article)
                                <div id="article_category_stripe_section{{$index}}" class="section">
                                        <h2 class="article_title_caric"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
                                        <div class="stripe_summary_holder">
                                            @if($article->image)
                                                <div class="image">
                                                    <a href="{{Common::article_link($article)}}">
                                                        <img src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="278" height="200" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
