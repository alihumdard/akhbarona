@extends("frontend.desktop.layouts.default")
@section("page-title"){{$article->title}}@stop
@section("page-des"){{$article->description?$article->description:($article->abstract?$article->abstract:(\App\Helper\Common::subWords($article->body,25)?htmlentities(\App\Helper\Common::subWords($article->body,25)):$article->title))}}@stop
@section("page-keyword"){{$keywords}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$article->title}}" href="{{\App\Helper\Common::article_rss($article)}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$article->category_name}}" href="{{\App\Helper\Common::cat_link($article,"rss")}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}feed/index.rss" />
@stop
@section("seo")
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{\App\Helper\Common::article_link($article,true)}}" hreflang="en" />
    <link rel="canonical" href="{{\App\Helper\Common::article_link($article)}}"/>
    <meta name="twitter:url" content="{{\App\Helper\Common::article_link($article)}}"/>
    <meta name="twitter:title" content="{{$article->title}}"/>
    <meta name="twitter:description" content="{{$article->description?$article->description:($article->abstract?$article->abstract:(\App\Helper\Common::subWords($article->body,25)?htmlentities(\App\Helper\Common::subWords($article->body,25)):$article->title))}}"/>
    <meta name="twitter:image" content="{{$metaImage}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$metaImage}}"/>
    <meta property="og:url" content="{{\App\Helper\Common::article_link($article)}}"/>
    @if(isset($setting["VIVVO_ARTICLE_LARGE_IMAGE_WIDTH"]))
    <meta property="og:image:width" content="{{$setting["VIVVO_ARTICLE_LARGE_IMAGE_WIDTH"]}}"/>
    @endif
    @if(isset($setting["VIVVO_ARTICLE_LARGE_IMAGE_HEIGHT"]))
    <meta property="og:image:height" content="{{$setting["VIVVO_ARTICLE_LARGE_IMAGE_HEIGHT"]}}"/>
    @endif
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
                                        <div class="swiper-slide">
										@if($article->image)
											<img class="img-fluid" src="{{$article->image}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}"/>
											<p>{{$article->image_caption ?? $article->title }}</p>
                                        @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------------------------------------- Newspaper-section Start  --------------------------------->
                    <div class="newspaper-sec">
                        <!---------------------------------- section start  آخر الأخبار-------------------------------->
                        <div class="newspaper-1 mt-3">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 mt-3 col-lg-3 mt-3">
                                        <div class="main-box">
                                            <img class="img-fluid" src="./images/newpaper-1.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                        <div class="main-box mt-3">
                                            <img class="img-fluid" src="./images/detail-img-1.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-9 mt-3">
                                        <div class="main-box">
                                            <div class="detail-heading">
                                                <h4>{{ $article->title }}</h4>
                                                <p>وزير الخارجية البريطاني الجديد: سنواصل تقديم الدعم المعنوي
                                                    والدبلوماسي والاقتصادي، لكن قبل كل شيء، الدعم العسكري الذي تحتاجون
                                                    إليه.. مهما طال الوقت
                                                    <br><br>

                                                    التقى وزير الخارجية البريطاني المعيّن حديثاً ديفيد كاميرون، الرئيس
                                                    الأوكراني فولوديمير زيلينسكي لإجراء محادثات في مجال الدفاع خلال
                                                    زيارة لأوكرانيا لم يعلن عنها مسبقاً، وفق ما أعلنت الرئاسة
                                                    الأوكرانية، اليوم الخميس.
                                                    <br><br>
                                                    وقال زيلينسكي في بيان على الشبكات الاجتماعية مرفق بصور تظهره مع
                                                    كاميرون: "أسلحة لجبهات القتال وتعزيز منظومات الدفاع الجوي وحماية
                                                    شعبنا والبنى التحتية الحيوية. أنا ممتن للمملكة المتحدة على دعمها".
                                                    <br><br>
                                                    وهذه الزيارة الأولى لكاميرون كوزير لخارجية المملكة المتحدة التي كانت
                                                    حليفاً عسكرياً وسياسياً لأوكرانيا منذ اندلاع الحرب مع روسيا.
                                                    <br><br>
                                                    التقى وزير الخارجية البريطاني المعيّن حديثاً ديفيد كاميرون، الرئيس
                                                    الأوكراني فولوديمير زيلينسكي لإجراء محادثات في مجال الدفاع خلال
                                                    زيارة لأوكرانيا لم يعلن عنها مسبقاً، وفق ما أعلنت الرئاسة
                                                    الأوكرانية، اليوم الخميس.
                                                    <br><br>
                                                    وقال زيلينسكي في بيان على الشبكات الاجتماعية مرفق بصور تظهره مع
                                                    كاميرون: "أسلحة لجبهات القتال وتعزيز منظومات الدفاع الجوي وحماية
                                                    شعبنا والبنى التحتية الحيوية. أنا ممتن للمملكة المتحدة على دعمها".


                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------- section End  آخر الأخبار---------------------------------->

                        <!-- adds section -->
                        <div class="adds-5 mb-3 mt-3">
                            <h3>Adds 5</h3>
                        </div>



                        <div class="newspaper-1 mt-3">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 mt-3 col-lg-3 mt-3">
                                        <div class="main-box">
                                            <img class="img-fluid" src="./images/akhirul-akhbar-5.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                        <div class="main-box mt-3">
                                            <img class="img-fluid" src="./images/akhirul-akhbar-9.png" alt="">
                                            <div class="main-box-text">
                                                <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 mt-3 col-lg-9 mt-3">
                                        <div class="main-box">
                                            <div class="detail-heading">
                                                <p>وزير الخارجية البريطاني الجديد: سنواصل تقديم الدعم المعنوي
                                                    والدبلوماسي والاقتصادي، لكن قبل كل شيء، الدعم العسكري الذي تحتاجون
                                                    إليه.. مهما طال الوقت
                                                    <br><br>

                                                    التقى وزير الخارجية البريطاني المعيّن حديثاً ديفيد كاميرون، الرئيس
                                                    الأوكراني فولوديمير زيلينسكي لإجراء محادثات في مجال الدفاع خلال
                                                    زيارة لأوكرانيا لم يعلن عنها مسبقاً، وفق ما أعلنت الرئاسة
                                                    الأوكرانية، اليوم الخميس.
                                                    <br><br>
                                                    وقال زيلينسكي في بيان على الشبكات الاجتماعية مرفق بصور تظهره مع
                                                    كاميرون: "أسلحة لجبهات القتال وتعزيز منظومات الدفاع الجوي وحماية
                                                    شعبنا والبنى التحتية الحيوية. أنا ممتن للمملكة المتحدة على دعمها".
                                                    <br><br>
                                                    وهذه الزيارة الأولى لكاميرون كوزير لخارجية المملكة المتحدة التي كانت
                                                    حليفاً عسكرياً وسياسياً لأوكرانيا منذ اندلاع الحرب مع روسيا.
                                                    <br><br>
                                                    التقى وزير الخارجية البريطاني المعيّن حديثاً ديفيد كاميرون، الرئيس
                                                    الأوكراني فولوديمير زيلينسكي لإجراء محادثات في مجال الدفاع خلال
                                                    زيارة لأوكرانيا لم يعلن عنها مسبقاً، وفق ما أعلنت الرئاسة
                                                    الأوكرانية، اليوم الخميس.
                                                    <br><br>
                                                    وقال زيلينسكي في بيان على الشبكات الاجتماعية مرفق بصور تظهره مع
                                                    كاميرون: "أسلحة لجبهات القتال وتعزيز منظومات الدفاع الجوي وحماية
                                                    شعبنا والبنى التحتية الحيوية. أنا ممتن للمملكة المتحدة على دعمها".


                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="newspaper-8" style="background: none;">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-3 ">
                                        <div class="akhirul-akhbar-sec-8">
                                            <div class="heading">
                                                <span>علوم وتكنولوجيا</span><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="10" height="47" viewBox="0 0 10 50"
                                                    style="margin-bottom: 8px; margin-left: -5px;" fill="none">
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
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-13.png" alt="">
                                                    <div class="main-box-text">
                                                        <p style="border-bottom: none;">الخطاب الملكي السامي بمناسبة
                                                            الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-14.png" alt="">
                                                    <div class="main-box-text">
                                                        <p style="border-bottom: none;">الخطاب الملكي السامي بمناسبة
                                                            الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-15.png" alt="">
                                                    <div class="main-box-text">
                                                        <p style="border-bottom: none;">الخطاب الملكي السامي بمناسبة
                                                            الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                                <div class="main-box">
                                                    <img class="img-fluid" src="./images/akhirul-akhbar-16.png" alt="">
                                                    <div class="main-box-text">
                                                        <p style="border-bottom: none;">الخطاب الملكي السامي بمناسبة
                                                            الذكرى 48 للمسيرة الخضراء</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Search Section Start -->

                        <section class="search-sec">
                            <div class="container-body">
                                <h4>اشترك في النشرة الإخبارية لدينا للحصول على آخر الأخبار</h4>
                                <div class="row last-search align-items-center">
                                    <div class="col-12 col-md-4 col-lg-3 mt-3">
                                        <div class="btns">
                                            <a href="#"><button>يشترك</button></a>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-8 col-lg-9 mt-3">
                                        <input class="form-control placeholder-css rtl me-2" type="search"
                                            placeholder="أدخل بريدك الإلكتروني" aria-label="Search">
                                    </div>
                                </div>
                            </div>
                        </section>


                        <!-- contact form -->
                        <section class="contact-us mt-3">
                            <h3 class="text-center">أضف تعليقك</h3>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div>
                                        <input class="form-control placeholder-css me-2" type="text"
                                        placeholder="أدخل بريدك الإلكتروني">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div>
                                        <input class="form-control placeholder-css me-2" type="text"
                                        placeholder="أدخل أسمك">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div>
                                        <div class="form-floating">
                                            <textarea class="form-control textarea-placeholder" placeholder="اكتب تعليق" id="floatingTextarea" style="height: 150px"></textarea>
                                          </div>
                                    </div>
                                    <div class="contact-us-btn text-center mt-4">

                                        <a href="#">إرسال تعليق</a>
                                    </div>
                                </div>
                            </div>
                        </section>
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
    <!-- <link media="all" type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/article_detail'.Config::get('app.css_extend').'.css') }}"> -->
    @if(count($galleries) > 0)
        <!-- <link type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/lightbox.css') }}"> -->
        <!-- <link type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/plugin_image_gallery.css') }}"> -->
    @endif
@stop
@section("header_scripts")
    <!-- <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/article.js?v=1.1') }}"></script> -->
@stop
@section("scripts")
    @if(Config::get("site.VIVVO_ANALYTICS_TRACKER_ID"))
        <script type="text/javascript">_gaq.push(['_trackEvent', 'Article', 'View', '{{$article->id}}', 1]);</script>
    @endif
	
@include("frontend.videojs")	
@stop

