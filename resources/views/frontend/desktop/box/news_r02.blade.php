@if(count($newsR02) > 0)
<div class="heading mt-4">
            <span>سياسة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
            viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
            <rect y="25" width="10" height="25" fill="#2E4866" />
            <rect width="10" height="25" fill="#C2111E" />
        </svg>
</div>
        <!-- horizantal line -->
        <hr class="red-line">
        <div class="row">
        <?php foreach($newsR02 as $key=>$article) { ?>
            @if($key < 3)
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-3">
                <div class="main-box">
                    <a href="{{Common::article_link($article)}}">
                        <img class="img-fluid" src="{{ $article->image ? $fileRepo->getLarge($article->image, true, $article->md5_file) : 'admin/assets/img/no-image.png' }}"  alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                    </a>
                    <!-- <img class="img-fluid" src="./images/newspaper-01.png" alt=""> -->
                    <div class="main-box-text">
                        <p><a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                    </div>
                </div>
            </div>
            @else
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-3">
                <div class="main-div d-flex">
                    <div>
                        <p class="pe-2"><a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a><p>
                    </div>
                    <div>
                        <img class="img-fluid" src="{{ $article->image ? $fileRepo->getLarge($article->image, true, $article->md5_file) : 'admin/assets/img/no-image.png' }}"  alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                    </div>
                </div>
            </div>
            @endif
            <?php } ?>

        </div>
@endif