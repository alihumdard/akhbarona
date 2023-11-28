@if(count($newsR12n) > 0)


<div class="heading mt-4">

    <a title="المزيد في الأخيرة" href="{{Common::mobileLink()}}last"> <span>الأخيرة</span></a><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
    <rect y="25" width="10" height="25" fill="#2E4866" />
    <rect width="10" height="25" fill="#C2111E" />
</svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
<?php $article = $newsR12n[0];unset($newsR12n[0])?>
<div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-6">
            <div class="row">
                @foreach($newsR12n as $article)
                <div class="col-md-6 mt-3">
                 
                    <div>
                    <a href="{{Common::article_link($article)}}">
                        <img class="img-fluid" src="{{$fileRepo->getSummaryLarge($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}">
                    </a>
                    </div>
                        <div class="main-box-text">
                            <p><a href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        


        <div class="col-12 col-md-12 col-lg-6 mt-3">
            <div class="news-6-last-img">
                @if($article->image)
                <div>
                    <a href="{{Common::article_link($article)}}">
                <img class="img-fluid"src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}">
            </a>
            </div>
            @endif
                <p><a href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
            </div>
        </div>

    </div>
</div>
@endif