@if(count($newsR07) > 0)
<div class="col-md-8 mt-3">
    <div class="row">
    <?php $article = $newsR07[0];unset($newsR07[0]); ?>
    <?php foreach($newsR07 as $index=> $art) { ?>
        <div class="col-md-6 mt-3">
            <div class="main-box">
                @if($art->image)
                    <a style="color:black; text-decoration:none;" href="{{Common::article_link($art)}}">
                        <img src="{{$fileRepo->getLarge($art->image,true,$art->md5_file)}}" alt="{{$art->image_caption?$art->image_caption:$art->title}}" /><br />
                    </a>
                @endif
                <div class="main-box-text">
                    <p><a style="color:black; text-decoration:none;" href="{{Common::article_link($art)}}">{{$article->title}}</a></p>
                </div>
            </div>
        </div>
    <?php } ?>

        <div class="col-md-12 mt-3">
            <div class="d-flex"
                style="border: 0.5px solid #D0D0D0;">
                <p><a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                    <!-- {{$article->abstract?$article->abstract:Common::subWords($article->body,25)}} @if($article->body)...@endif
                        @if(!$article->link)
                            @if($article->body)
                                <span class="mor_full"><a href="{{Common::article_link($article)}}">{{Config::get("site.lang.LNG_FULL_STORY")}}</a></span>
                            @endif
                        @else
                            <a class="visit" href="{{$article->link}}"><img src="{{$fileRepo->getDesktopUrl("img/external.png")}}" alt="{{Config::get("site.lang.LNG_VISIT_WEBSITE")}}"/></a>
                        @endif -->
                <div style="width: 207px; height: auto;">
                    @if($article->image)
                        <a  href="{{Common::article_link($article)}}">
                            <img class="img-fluid h-100" src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="250" height="200" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>


@endif
