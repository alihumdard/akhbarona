<div class="heading mt-4">
    <span>ثقافة وفنون</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
    <rect y="25" width="10" height="25" fill="#2E4866" />
    <rect width="10" height="25" fill="#C2111E" />
</svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
<div>
    <div class="row">
        @foreach($newsR11n as $article)
            <div class="col-md-4 mt-3">
                <div class="main-box">
                @if($article->image)
                    <a href="{{Common::article_link($article)}}">
                        <img class="img-fluid" src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" width="191" height="140" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                    </a>
                @endif
                <div class="main-box-text">
                    <p> <a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                </div>
            </div>
            </div>
        @endforeach
    </div>
</div>
