<div class="heading mt-4">
    <span>اخبار وطنية</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
    <rect y="25" width="10" height="25" fill="#2E4866" />
    <rect width="10" height="25" fill="#C2111E" />
</svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
<div class="swiper newspaperSwipper">
    <div class="swiper-wrapper">
        @foreach($newsR01n as $article)
        <div class="swiper-slide">
            <div class="card">
                <img class="img-fluid card-img-top" src="./images/swiper-slide-1.png" alt="">
                <div class="card-body p-3">
                    <p><a href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div class="down-dots d-flex align-items-center mt-5">
        <div class="swiper-button-prev">
            <img src="./images/carousel-btn-left.png" alt="" class="img-arrow">
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next">
            <img src="./images/carousel-btn.png" alt="" class="img-arrow">
        </div>
    </div>
</div>