@if(count($newsR05) > 0)
<div class="heading mt-4">
    <a href="href="{{Common::mobileLink()}}sport""><span>رياضة</span></a><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
    <rect y="25" width="10" height="25" fill="#2E4866" />
    <rect width="10" height="25" fill="#C2111E" />
</svg>
</div>
        <!-- horizantal line -->
        <hr class="red-line">
        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="hero-sec-adds-4">
                    <h3>Adds 5</h3>
                </div>
            </div>
            <div class="col-md-8 mt-3">
                <div class="row">
                <?php foreach($newsR05 as $index=>$article) { ?>
                    @if($index < 4)
                    <div class="col-md-6 mt-3">
                        <div class="main-box">
                            <a href="{{Common::article_link($article)}}">
                                <img class="img-fluid" src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                            </a>
                            <div class="main-box-text">
                                <p><a href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                            </div>
                        </div>
                    </div>
                @else
           <div class="col-md-12 mt-3">
                    <div class="d-flex" style="border: 0.5px solid #D0D0D0;">
                        <p><a href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                        <div class="image">
                            <a href="{{Common::article_link($article)}}">
                                <img class="img-fluid h-100" src="{{ $article->image ? $fileRepo->getLarge($article->image,true,$article->md5_file) : 'admin/assets/img/no-image.png' }}"  alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                            </a>
                            
                        </div>
                    </div>
                </div>
            @endif
            <?php } ?>

        </div>
        </div>
@endif