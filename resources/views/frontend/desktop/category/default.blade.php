@extends("frontend.desktop.layouts.default")
@section("page-title"){{$category->category_name}}@stop
@section("page-des"){{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-keyword"){{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$category->category_name}}" href="{{\App\Helper\Common::cat_link(null,"rss",$category->id)}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}feed/index.rss" />
@stop
@section("seo")
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{$alternate}}" hreflang="en" />
    <link rel="canonical" href="{{$canonical}}"/>
    <meta name="twitter:url" content="{{$canonical}}"/>
    <meta name="twitter:title" content="{{$category->category_name}}"/>
    <meta name="twitter:description" content="{{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}"/>
    <meta name="twitter:image" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
    <meta property="og:url" content="{{$canonical}}"/>
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

                    <!-------------------------------------- Newspaper-section Start  --------------------------------->
                    <div class="newspaper-sec">
                        <!---------------------------------- section start  آخر الأخبار-------------------------------->
                        <div class="akhirul-akhbar-main-sec mt-3">
                            <div class="heading mb-5 me-3">
                                <span style="background: none; color: white; font-size: 27px;">
                                <!-- <a href="{{Config::get("app.url")}}">{{Config::get("site.lang.LNG_GO_HOME")}}</a> | -->
                                    {{$category->category_name}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
                                    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                                    <rect y="25" width="10" height="25" fill="#2E4866" />
                                    <rect width="10" height="25" fill="#C2111E" />
                                </svg>
                            </div>
                        </div>
                        <div class="newspaper-1">
                            <div>
                                <div class="row">
                                    @if($arrData["total"] > 0)
                                        <?php $articles = $arrData["data"];$article = $articles[0];unset($articles[0]);?>
                                        <!-- @include("frontend.desktop.summary.vertical",["slug"=>$category->sefriendly,$article,$fileRepo,$setting]) -->
                                        <!-- <center>@include("frontend.desktop.adv.insection")</center> -->
                                        @foreach($articles as $article)
                                            @include("frontend.desktop.summary.default",["slug"=>$category->sefriendly,$article,$fileRepo,$setting])
                                        @endforeach
                                    @else
                                        <h5 class="subtitle">{{Config::get("site.lang.LNG_NO_ENTRIES")}}</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!---------------------------------- section End  آخر الأخبار---------------------------------->

                        <div class="newspaper-5">
                            <div>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="hero-sec-adds-4">
                                            <h3>Adds 5</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-1.png" alt="">
                                                    <div class="main-box-text">
                                                        <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-2.png" alt="">
                                                    <div class="main-box-text">
                                                        <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-3.png" alt="">
                                                    <div class="main-box-text">
                                                        <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-4.png" alt="">
                                                    <div class="main-box-text">
                                                        <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="d-flex"
                                                    style="border: 0.5px solid #D0D0D0;">
                                                    <p>علاكوش يَشرح لـ"أخبارنا" أسباب استدعاء "أخنوش" النقابات منفردة..
                                                        ويُفصّل في مخرجات "لقاء الاثنين"</p>
                                                    <div>
                                                        <img class="img-fluid h-100" src="./images/newspaper-10.png" alt="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="adds-5 mt-3">
                            <h3>Adds</h3>
                        </div>

                        <div class="newspaper-1">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 mt-3 col-lg-3 mt-3">
                                        <div class="main-box">
                                             <img class="img-fluid" src="./images/akhirul-akhbar-5.png" alt="">                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                             <img class="img-fluid" src="./images/akhirul-akhbar-6.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                             <img class="img-fluid" src="./images/akhirul-akhbar-7.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                             <img class="img-fluid" src="./images/akhirul-akhbar-8.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                             <img class="img-fluid" src="./images/akhirul-akhbar-9.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                             <img class="img-fluid" src="./images/akhirul-akhbar-10.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                             <img class="img-fluid" src="./images/akhirul-akhbar-11.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                             <img class="img-fluid" src="./images/akhirul-akhbar-12.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="newspaper-8" style="background: none;">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-3 ps-0">
                                        <div class="akhirul-akhbar-sec-8">
                                                 <div class="heading">
                                            <span>علوم وتكنولوجيا</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
                                            viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                                            <rect y="25" width="10" height="25" fill="#2E4866" />
                                            <rect width="10" height="25" fill="#C2111E" />
                                        </svg>
                                        </div>
                                        <!-- horizantal line -->
                                        <div class="container">
                                          <hr class="red-line">   
                                        </div>
                                       
                                        <div class="main-div">
                                            <div>
                                                <p>حذاري : تطبيق شهير يستنزف بطارية هاتفك</p>
                                                <p>حذاري : تطبيق شهير يستنزف بطارية هاتفك</p>
                                                <p>حذاري : تطبيق شهير يستنزف بطارية هاتفك</p>
                                                <p>حذاري : تطبيق شهير يستنزف بطارية هاتفك
                                                </p>
                                                <div class="mt-3">
                                                    <a href="#">
                                                        <button style="margin-right: 10px; margin-bottom: 10px;">
                                                            اقرأ أكثر
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div> 
                                        </div>
                                  
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-3" >
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-13.png" alt="">
                                                    <div class="main-box-text">
                                                        <p style="border-bottom: none;">الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-14.png" alt="">
                                                    <div class="main-box-text">
                                                        <p style="border-bottom: none;">الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-15.png" alt="">
                                                    <div class="main-box-text">
                                                        <p style="border-bottom: none;">الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-16.png" alt="">
                                                    <div class="main-box-text">
                                                        <p style="border-bottom: none;">الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="newspaper-1">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3 ">
                                        <div class="main-box">
                                              <img class="img-fluid" src="./images/akhirul-akhbar-17.png" alt="">                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                              <img class="img-fluid" src="./images/akhirul-akhbar-18.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                              <img class="img-fluid" src="./images/akhirul-akhbar-19.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                              <img class="img-fluid" src="./images/akhirul-akhbar-20.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                              <img class="img-fluid" src="./images/akhirul-akhbar-21.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                              <img class="img-fluid" src="./images/akhirul-akhbar-22.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                              <img class="img-fluid" src="./images/akhirul-akhbar-23.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                        <div class="main-box">
                                              <img class="img-fluid" src="./images/akhirul-akhbar-24.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="paginations mt-3">
                                    @if($parent)
                                        @include("frontend.desktop.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.level2","routeParam"=>["parent"=>$parent,"slug"=>$category->sefriendly,"page"=>1]])
                                    @else
                                        @include("frontend.desktop.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.index","routeParam"=>["slug"=>$category->sefriendly,"page"=>1]])
                                    @endif
                            </div>
                        </div>

                        <div class="newspaper-9 mt-3">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">
                                        <div class="heading">
                                            <span>كاريكاتير وصورة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
                                            viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                                            <rect y="25" width="10" height="25" fill="#2E4866" />
                                            <rect width="10" height="25" fill="#C2111E" />
                                        </svg>
                                        </div>
                                        <!-- horizantal line -->
                                        <hr class="red-line">
                                        <div style="border-right: 1px solid #D8D8D8; padding-right: 10px;">
                                            <div class="main-div mt-3">
                                                <img class="img-fluid" src="./images/newspaper-36.png" alt="">
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
                                        <div class="heading">
                                            <span>مباريات ووظائف</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
                                            viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                                            <rect y="25" width="10" height="25" fill="#2E4866" />
                                            <rect width="10" height="25" fill="#C2111E" />
                                        </svg>
                                        </div>
                                        <!-- horizantal line -->
                                        <hr class="red-line">
                                        <div class="main-div mt-3">
                                            <img class="img-fluid" src="./images/newspaper-38.png" alt="">
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
                            </div>
                        </div>

                        <div class="hero-sec-adds-2 mt-3">
                            <h3>Adds</h3>
                        </div>
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
    <!-- <link media="all" type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/category'.Config::get('app.css_extend').'.css') }}"> -->
@stop
@section("header_scripts")
    <!-- <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js?v='.Config::get('app.home_js_version')) }}"></script> -->
@stop
