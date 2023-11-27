<div class="heading mt-4">
    <span>أقلام حرة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
        <rect y="25" width="10" height="25" fill="#2E4866"></rect>
        <rect width="10" height="25" fill="#C2111E"></rect>
    </svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
<div>
    <div class="row">
    @foreach($newsL2 as $index=>$article)
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3">
            <div class="news-main-box d-flex" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px; border-bottom-left-radius: 44px; border-top-left-radius: 44px; overflow: hidden;">
                <div style="flex: 1;">
                    <p><a style="color:white; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                </div>
                @if($article->image)
                    <div style="flex: 1; display: flex; align-items: center; justify-content: flex-end;">
                        <a href="{{Common::article_link($article)}}">
                            <div style="height: 100px; width: 100px; overflow: hidden; border-radius: 50%;">
                                <img class="image-fluid" src="{{$fileRepo->getSummaryMedium($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" style="height: 100%; width: 100%; object-fit: cover;">
                            </div>
                        </a>
                    </div>
                @endif  
            </div>
        </div>
    @endforeach
    </div>
</div>