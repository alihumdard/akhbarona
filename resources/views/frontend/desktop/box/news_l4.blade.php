<div class="heading mt-4">
    <span>ركن المرأة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
    <rect y="25" width="10" height="25" fill="#2E4866" />
    <rect width="10" height="25" fill="#C2111E" />
</svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
<div>
    <div class="row">
        @foreach($newsL4 as $article)
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-3">
                <div class="main-sec d-flex justify-content-between align-items-center">
                    <div>
                        <p><a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                    </div>
                    <div>
                        @if($article->image)
                            <a href="{{Common::article_link($article)}}">
                                <img class="image-fluid" src="{{$fileRepo->getSummaryLarge($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>