<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 mt-3">
        <div class="hero-sec-adds-4">
            <h3>Adds 4</h3>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-8 mt-3">
        <div class="hero-swiper">
           <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
            class="swiper mySwiper2">
            <div class="swiper-wrapper">
                @foreach($fancyHeadlines as $index=>$article)
                @if($article->image)
                <div class="swiper-slide">
                    <a href="{{Common::article_link($article)}}">
                    <img  class="img-fluid" src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" width="586" height="430"/>
                    </a>
                    <p><a href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                </div>
                @endif
                @endforeach
            </div>
            <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->
        </div>
        <div thumbsSlider="" class="swiper mySwiper pt-3">
            <div class="swiper-wrapper">
                @foreach($fancyHeadlines as $index=>$article)
                <div class="swiper-slide">
                    <a href="#rotating_headlines_{{$index}}">
                        <img src="{{$fileRepo->getSmall($article->image,true,$article->md5_file)}}"  alt="{{$article->image_caption?$article->image_caption:$article->title}}" width="62" height="49"/>
                </a>
                </div>
                @endforeach
            </div>
        </div>  
        </div>
        </div>
        </div>
    </div>
    <div class="col-md-2"></div>
 </div>