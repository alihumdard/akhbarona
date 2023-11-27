@if(count($newsR06) > 0)
<div class="heading mt-4">
    <span>دولية</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
    <rect y="25" width="10" height="25" fill="#2E4866" />
    <rect width="10" height="25" fill="#C2111E" />
</svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
<div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-6">
        <?php 
            $article1 = $newsR06[0];
            unset($newsR06[0]);
         ?>
            <div class="row">
            <?php foreach($newsR06 as $index=>$article) { ?>
                <div class="col-md-6 mt-3">
                    <div class="main-box" style="border: none;">
                        @if($article->image)
                            <div class="image">
                                <a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">
                                    <img class="img-fluid" src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                                </a>
                            </div>
                        @endif
                        <div class="main-box-text">
                            <p><a style="color:black; text-decoration:none;"  href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-6 mt-3">
            <div class="news-6-last-img">
                @if($article1->image)
                        <a style="color:black; text-decoration:none;"  href="{{Common::article_link($article1)}}">
                            <img class="img-fluid" src="{{$fileRepo->getLarge($article1->image,true,$article1->md5_file)}}"  alt="{{$article1->image_caption?$article1->image_caption:$article1->title}}" />
                        </a>
                @endif
                <p><a style="color:black; text-decoration:none;"  href="{{Common::article_link($article1)}}">{{$article->title}}</a></p>
                <!-- {{$article1->abstract?$article1->abstract:Common::subWords($article1->body,25)}} @if($article1->body)...@endif
                @if(!$article1->link)
                    @if($article1->body)
                        <span class="mor_full"><a style="color:black; text-decoration:none;"  href="{{Common::article_link($article1)}}">{{Config::get("site.lang.LNG_FULL_STORY")}}</a></span>
                    @endif
                @else
                    <a style="color:black; text-decoration:none;"  class="visit" href="{{$article1->link}}"><img src="{{$fileRepo->getDesktopUrl("img/external.png")}}" alt="{{Config::get("site.lang.LNG_VISIT_WEBSITE")}}"/></a>
                @endif -->
            </div>
        </div>
    </div>
</div>
@endif
