@if(count($newsR08) > 0)
<div class="heading mt-4">
    <span>دين ودنيا</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
    <rect y="25" width="10" height="25" fill="#2E4866" />
    <rect width="10" height="25" fill="#C2111E" />
</svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
<div>
    <div class="row">
    <?php foreach($newsR08 as $index=>$article) { ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
            <div class="main-box">
            @if($article->image)
                <a href="{{Common::article_link($article)}}">
                    <img src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="161" height="110" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                </a>
            @endif
                <div class="main-box-text">
                    <p><a style="color:black; text-decoration:none;"  href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>







@endif
