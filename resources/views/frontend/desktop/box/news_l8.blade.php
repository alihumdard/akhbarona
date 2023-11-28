<div class="heading">
    <span>مباريات ووظائف</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
    <rect y="25" width="10" height="25" fill="#2E4866" />
    <rect width="10" height="25" fill="#C2111E" />
</svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
@foreach($newsL8 as $article)
<div class="main-div mt-3">
    @if($article->image)
        <a href="{{Common::article_link($article)}}">
            <img class="image-fluid" src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
        </a>
    @endif
    <div>
        <p><a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
        <div>
            <a href="{{Common::article_link($article)}}">
                <button>
                    اقرأ أكثر
                </button>
            </a>
        </div>
    </div>
</div>
@endforeach