@if(count($newsR03) > 0)
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
<div class="newspaper-3">
    <div class="heading mt-4">
        <a href="{{Common::mobileLink()}}economy"><span style="padding:10px 15px;background: #f5f8f9; font-size: 20px; font-weight: 700;">إقتصاد</span></a><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
        viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
        <rect y="25" width="10" height="25" fill="#2E4866" />
        <rect width="10" height="25" fill="#C2111E" />
    </svg>
    </div>
    <!-- horizantal line -->
    <hr class="red-line">
    <div>
        <?php $article = $newsR03[0];unset($newsR03[0]); ?>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3">
          
                <div class="news-main-box d-flex">
                    <div>
                        <p>إقليم الإندلس.. الاحتفاء بالمغرب وتنوعه الثقافي خلال شهر نونبر</p>
                    </div>
                    <div>
                        <img src="./images/news-radius-1.png" alt="">
                    </div>
                </div>
            </div>
            <?php foreach($newsR03 as $index=>$article) { ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                <div class="news-main-box d-flex">
                    <div>
                        <p><a href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                    </div>
                    @if($article->image)
                    <div href="{{Common::article_link($article)}}">
                       <a ><img width="113px" height="89px" src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" alt=""></a>
                    </div>
                    @endif
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
<div class="col-md-2"></div>
</div>
@endif