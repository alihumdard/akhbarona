
    
@extends("frontend.desktop.layouts.homepage")
@section("page-title"){{$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-des"){{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}@stop
@section("page-keyword"){{$setting["VIVVO_GENERAL_META_KEYWORDS"]}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}feed/index.rss" />
@stop
@section("seo")
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{Config::get("app.url")}}mobile" hreflang="en" />
    <link rel="canonical" href="{{Config::get("app.url")}}"/>
    <meta name="twitter:url" content="{{Config::get("app.url")}}"/>
    <meta name="twitter:title" content="{{$setting["VIVVO_WEBSITE_TITLE"]}}"/>
    <meta name="twitter:description" content="{{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}"/>
    <meta name="twitter:image" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
    <meta property="og:url" content="{{Config::get("app.url")}}"/>
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="450"/>
@stop
@section("header_menu")
    @include('frontend.desktop.box.header')
    @include("frontend.desktop.adv.headline_banner")
@stop
@section("content")
    

    <!-- Hero section Start -->
    <section class="hero-sec mt-3">
        <div class="container-body">
            <div class="row">
                <div class="col-md-2 pe-0">
                    <div class="hero-sec-adds-1">
                        <h3>Adds 1</h3>
                    </div>
                </div>
                <div class="col-md-8 px-0">
                    <div class="hero-sec-adds-2">
                        <h3>Adds 2</h3>
                    </div>
                    <!--______________________________ Hero section Buttons Start ______________________________________-->
                    <div class=" hero-sec-button mt-3 d-flex" style="gap: 10px;">
                        <div class="order-2 order-lg-1">
                            <a href="#"><button>العلامات</button></a>
                            <a href="#"><button>العلامات</button></a>
                            <a href="#"><button>العلامات</button></a>
                            <a href="#"><button>العلامات</button></a>
                            <a href="#"><button>العلامات</button></a>

                        </div>
                        <h5 class="order-1 order-lg-2" style="color: #C2111E;"> :الكلمات الشعبية</h5>
                    </div>
                        <!--______________________________ Hero section Buttons End ______________________________________-->

                            <!--______________________________ Hero section Swiper start _________________________________-->
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 mt-3">
                            <div class="hero-sec-adds-4">
                                <h3>Adds 4</h3>
                            </div>
                        </div>
                             @include("frontend.desktop.box.fancy_headlines",[$fancyHeadlines,$fileRepo,$setting])
                        </div>
                       <!--______________________________ Hero section Swiper End ___________________________________-->


                    <!--________________________________ Newspaper-section Start  ________________________________-->
                    <div class="newspaper-sec">
                        <!------------------- section start  آخر الأخبار------------------------>
                        <div class="newspaper-1">    
                             @include("frontend.desktop.box.latest_news_bh_sw",[$latestNewsBhSw,$fileRepo])

                        </div>
                        <!---------------------------------- section End  آخر الأخبار---------------------------------->

                        <!-- adds section -->
                        <div class="adds-5 mb-3 mt-3">
                            <h3>Adds 5</h3>
                        </div>

                        <!---------------------------------- section start شاشة أخبارن-------------------------------->
                        <div class="newspaper-2">
                            @include("frontend.desktop.box.news_l1",$columnLeft)
                        </div>
                        <!---------------------------------- section End شاشة أخبارن---------------------------------->

                        <!---------------------------------- section start إقتصاد------------------------------------->
                        <div class="newspaper-3">
                            @include("frontend.desktop.box.news_r03",$columnCenter)
                        </div>
                        <!---------------------------------- section End إقتصاد--------------------------------------->

                        <!---------------------------------- section start سياسة-------------------------------------->
                        <div class="newspaper-4">
                            @include("frontend.desktop.box.news_r02",$columnCenter)
                        </div>
                        <!---------------------------------- section End سياسة---------------------------------------->

                         <!---------------------------------- section Start أقلام حرة---------------------------------------->
                         <div class="newspaper-3">
                            @include("frontend.desktop.box.news_l2",$columnLeft)
                        </div>
                         <!---------------------------------- section End أقلام حرة---------------------------------------->

                        <!------------------------------------- newspaper-slider Section Start ------------------------------------->
                      <div class="newspaper-slider mt-3">
                        @include("frontend.desktop.box.news_r01n",$columnCenter)
                        </div>
                        <script>
                            const swipers = new Swiper('.newspaperSwipper', {
                                speed: 600,
                                loop: true,
                                autoplay: {
                                    delay: 3000,
                                    disableOnInteraction: false
                                },
                                slidesPerView: 3,
                                breakpoints: {
                                    320: { slidesPerView: 1, spaceBetween: 10 },
                                    768: { slidesPerView: 2, spaceBetween:10 },
                                    992: { slidesPerView: 3, spaceBetween: 10},
                                    1920: { slidesPerView: 3, spaceBetween: 10}
                                },
                                pagination: {
                                  el: '.swiper-pagination',
                                  type: 'bullets',
                                  clickable: true
                                },
                                navigation: {
                                  nextEl: ".swiper-button-next",
                                  prevEl: ".swiper-button-prev",
                                },
                              });
                        </script>
                        <!--________________________ newspaper-slider Section End __________________________-->

                         <!---------------------------------- section start رياضة---------------------------->
                        <div class="newspaper-5">
                            @include("frontend.desktop.box.news_r05",$columnCenter)
                        </div>
                         <!---------------------------------- section End رياضة---------------------------->

                          <!---------------------------------- section start حوادث وقضايا---------------------------->
                        <div class="newspaper-4">
                             @include("frontend.desktop.box.news_r04",$columnCenter)
                        </div>
                          <!---------------------------------- section End حوادث وقضايا---------------------------->

                           <!---------------------------------- section start دولية---------------------------->
                        <div class="newspaper-6 mt-3" style="background-color: #F9F9F9; padding: 10px 15px;">
                             @include("frontend.desktop.box.news_r06",$columnCenter)    
                        </div>
                           <!---------------------------------- section End دولية---------------------------->


                         <!---------------------------------- section start دين ودنيا---------------------------->
                        <div class="newspaper-7">
                            @include("frontend.desktop.box.news_r08",$columnCenter)
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="hero-sec-adds-2">
                                <h3>Adds-6</h3>
                            </div>
                        </div>
                         <!---------------------------------- section End دين ودنيا---------------------------->


                        <!---------------------------------- section start مستجدات التعليم---------------------------->
                        <div class="newspaper-5">
                            <div class="heading mt-4">
                                <span>مستجدات التعليم</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
                                viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                                <rect y="25" width="10" height="25" fill="#2E4866" />
                                <rect width="10" height="25" fill="#C2111E" />
                            </svg>
                            </div>
                            <!-- horizantal line -->
                            <hr class="red-line">
                            <div>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="hero-sec-adds-4">
                                            <h3>Adds 5</h3>
                                        </div>
                                    </div>
                                    @include("frontend.desktop.box.news_r07",$columnCenter)
                                </div>
                            </div>

                        </div>
                        <!---------------------------------- section End مستجدات التعليم---------------------------->

                        <!---------------------------------- section Start علوم وتكنولوجيا- ----------------------------->
                        <div class="newspaper-8 mt-3">
                            <div class="row">
                                @include("frontend.desktop.box.news_r10n",$columnCenter)
                                @include("frontend.desktop.box.news_r09n",$columnCenter)
                            </div>
                        </div>
                        <!---------------------------------- section End علوم وتكنولوجيا- ----------------------------->

                           <!---------------------------------- section start ثقافة وفنون---------------------------->
                        <div class="newspaper-7">
                        @include("frontend.desktop.box.news_r11n",$columnCenter)
                        </div>
                         <!---------------------------------- section End ثقافة وفنون---------------------------->

                         <!---------------------------------- section start كاريكاتير وصورة------------------->
                        <div class="newspaper-9 mt-3">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">
                                         @include("frontend.desktop.box.news_l5",$columnLeft)
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">
                                        <div class="heading">
                                            <span>متفرقات</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
                                            viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                                            <rect y="25" width="10" height="25" fill="#2E4866" />
                                            <rect width="10" height="25" fill="#C2111E" />
                                        </svg>
                                        </div>
                                        <!-- horizantal line -->
                                        <hr class="red-line">
                                        <div style="border-right: 1px solid #D8D8D8; padding-right: 10px;">
                                            <div class="main-div mt-3">
                                                <img class="img-fluid" src="./images/newspaper-37.png" alt="">
                                                <div>
                                                    <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    <div>
                                                        <a href="#">
                                                            <button>
                                                                اقرأ أكثر
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-3">
                                        @include("frontend.desktop.box.news_l8",$columnLeft)
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!---------------------------------- section End كاريكاتير وصورة--------------------->


                         <!---------------------------------- section start ركن المرأة------------------------>
                        <div class="newspaper-10">
                            @include("frontend.desktop.box.news_l4",$columnLeft)
                        </div>
                         <!---------------------------------- section End ركن المرأة-------------------------->

                         <!---------------------------------- section start الأخيرة---------------------------->
                        <div class="newspaper-6 mt-3">
                            <div class="heading mt-4">
                                <span>الأخيرة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
                                viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                                <rect y="25" width="10" height="25" fill="#2E4866" />
                                <rect width="10" height="25" fill="#C2111E" />
                            </svg>
                            </div>
                            <!-- horizantal line -->
                            <hr class="red-line">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <div class="main-box" style="border: none;">
                                                    <img class="img-fluid" src="./images/akhitrata-1.png" alt="">
                                                    <div class="main-box-text">
                                                        <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="main-box" style="border: none;">
                                                    <img class="img-fluid" src="./images/akhitrata-2.png" alt="">
                                                    <div class="main-box-text">
                                                        <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="main-box" style="border: none;">
                                                    <img class="img-fluid" src="./images/akhitrata-3.png" alt="">
                                                    <div class="main-box-text">
                                                        <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="main-box" style="border: none;">
                                                    <img class="img-fluid" src="./images/akhitrata-4.png" alt="">
                                                    <div class="main-box-text">
                                                        <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-6 mt-3">
                                        <div class="news-6-last-img">
                                            <img class="img-fluid" src="./images/akhitrata-5.png" alt="">
                                            <p>الملك: أنبوب غاز المغرب-نيجيريا مشروع للاندماج الجهوي.. ومشاكل الساحل لن
                                                تُحلّ بالأبعاد الأمنية فقط</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                         <!---------------------------------- section End الأخيرة------------------------------>

                    </div>
                </div>
                <div class="col-md-2 ps-0">
                    <div class="hero-sec-adds-3">
                        <h3>Adds-3</h3>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @stop
  
@section("styles")
    <link media="all" type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/homepage'.Config::get('app.css_extend').'.css') }}">
@stop
@section("header_scripts")
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js?v='.Config::get('app.home_js_version')) }}"></script>
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/rotating_headlines.js?v=1') }}"></script>
@stop
