 <?php $__env->startSection("page-title"); ?><?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-des"); ?><?php echo e($setting["VIVVO_GENERAL_META_DESCRIPTION"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-keyword"); ?><?php echo e($setting["VIVVO_GENERAL_META_KEYWORDS"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("rss"); ?> <link rel="alternate" type="application/rss+xml" title="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>" href="<?php echo e(Config::get("app.url")); ?>feed/index.rss" /> <?php $__env->stopSection(); ?> <?php $__env->startSection("seo"); ?> <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo e(Config::get("app.url")); ?>mobile" hreflang="en" /> <link rel="canonical" href="<?php echo e(Config::get("app.url")); ?>"/> <meta name="twitter:url" content="<?php echo e(Config::get("app.url")); ?>"/> <meta name="twitter:title" content="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>"/> <meta name="twitter:description" content="<?php echo e($setting["VIVVO_GENERAL_META_DESCRIPTION"]); ?>"/> <meta name="twitter:image" content="<?php echo e($cdnUrl."themes/akhbarona210/img/logo_social.png"); ?>"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("og_image"); ?> <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo e($cdnUrl."themes/akhbarona210/img/logo_social.png"); ?>"/> <meta property="og:url" content="<?php echo e(Config::get("app.url")); ?>"/> <meta property="og:image:width" content="800"/> <meta property="og:image:height" content="450"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("header_menu"); ?> <?php echo $__env->make('frontend.desktop.box.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.adv.headline_banner", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection("content"); ?> <section class="hero-sec mt-3"> <div class="container-body"> <div class="row"> <div class="col-md-2 pe-0"> <div class="hero-sec-adds-1"> <h3>Adds 1</h3> </div> </div> <div class="col-md-8 px-0"> <div class="hero-sec-adds-2"> <h3>Adds 2</h3> </div> <div class=" hero-sec-button mt-3 d-flex" style="gap: 10px;"> <div class="order-2 order-lg-1"> <a href="#"><button>العلامات</button></a> <a href="#"><button>العلامات</button></a> <a href="#"><button>العلامات</button></a> <a href="#"><button>العلامات</button></a> <a href="#"><button>العلامات</button></a> </div> <h5 class="order-1 order-lg-2" style="color: #C2111E;"> :الكلمات الشعبية</h5> </div> <div class="row"> <div class="col-12 col-sm-12 col-md-12 col-lg-4 mt-3"> <div class="hero-sec-adds-4"> <h3>Adds 4</h3> </div> </div> <?php echo $__env->make("frontend.desktop.box.fancy_headlines",[$fancyHeadlines,$fileRepo,$setting], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="newspaper-sec"> <div class="newspaper-1"> <?php echo $__env->make("frontend.desktop.box.latest_news_bh_sw",[$latestNewsBhSw,$fileRepo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="adds-5 mb-3 mt-3"> <h3>Adds 5</h3> </div> <div class="newspaper-2"> <div class="heading"> <span>شاشة أخبارنا</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div> <div class="row"> <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3"> <a href="#"> <div class="video-box-1"> <div class="icon mb-3 mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"> <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white" stroke-width="2" /> <path d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z" fill="white" /> </svg> </div> <p>جدل في فرنسا بسبب صلاة جماعية لمسلمين...</p> </div> </a> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3"> <a href="#"> <div class="video-box-2"> <div class="icon mb-3 mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"> <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white" stroke-width="2" /> <path d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z" fill="white" /> </svg> </div> <p>جدل في فرنسا بسبب صلاة جماعية لمسلمين...</p> </div> </a> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3"> <a href="#"> <div class="video-box-3"> <div class="icon mb-3 mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"> <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white" stroke-width="2" /> <path d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z" fill="white" /> </svg> </div> <p>جدل في فرنسا بسبب صلاة جماعية لمسلمين...</p> </div> </a> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3"> <a href="#"> <div class="video-box-4"> <div class="icon mb-3 mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"> <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white" stroke-width="2" /> <path d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z" fill="white" /> </svg> </div> <p>جدل في فرنسا بسبب صلاة جماعية لمسلمين...</p> </div> </a> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3"> <a href="#"> <div class="video-box-5"> <div class="icon mb-3 mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"> <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white" stroke-width="2" /> <path d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z" fill="white" /> </svg> </div> <p>جدل في فرنسا بسبب صلاة جماعية لمسلمين...</p> </div> </a> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3"> <a href="#"> <div class="video-box-6"> <div class="icon mb-3 mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"> <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white" stroke-width="2" /> <path d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z" fill="white" /> </svg> </div> <p>جدل في فرنسا بسبب صلاة جماعية لمسلمين...</p> </div> </a> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3"> <a href="#"> <div class="video-box-7"> <div class="icon mb-3 mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"> <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white" stroke-width="2" /> <path d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z" fill="white" /> </svg> </div> <p>جدل في فرنسا بسبب صلاة جماعية لمسلمين...</p> </div> </a> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3"> <a href="#"> <div class="video-box-8"> <div class="icon mb-3 mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none"> <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white" stroke-width="2" /> <path d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z" fill="white" /> </svg> </div> <p>جدل في فرنسا بسبب صلاة جماعية لمسلمين...</p> </div> </a> </div> </div> </div> </div> <div class="newspaper-3"> <?php echo $__env->make("frontend.desktop.box.news_r03",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="newspaper-4"> <?php echo $__env->make("frontend.desktop.box.news_r02",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="newspaper-3"> <?php echo $__env->make("frontend.desktop.box.news_l2",$columnLeft, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="newspaper-slider mt-3"> <div class="heading mt-4"> <span>اخبار وطنية</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div class="swiper newspaperSwipper"> <div class="swiper-wrapper"> <div class="swiper-slide"> <div class="card"> <img class="img-fluid card-img-top" src="./images/swiper-slide-1.png" alt=""> <div class="card-body p-3"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="swiper-slide"> <div class="card"> <img class="img-fluid card-img-top" src="./images/video-bg-5.png" alt=""> <div class="card-body p-3"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="swiper-slide"> <div class="card"> <img class="img-fluid card-img-top" src="./images/video-bg-8.png" alt=""> <div class="card-body p-3"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="swiper-slide"> <div class="card"> <img class="img-fluid card-img-top" src="./images/video-bg-5.png" alt=""> <div class="card-body p-3"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> </div> <div class="down-dots d-flex align-items-center mt-5"> <div class="swiper-button-prev"> <img src="./images/carousel-btn-left.png" alt="" class="img-arrow"> </div> <div class="swiper-pagination"></div> <div class="swiper-button-next"> <img src="./images/carousel-btn.png" alt="" class="img-arrow"> </div> </div> </div> </div> <div class="newspaper-5"> <div class="heading mt-4"> <span>رياضة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div> <div class="row"> <div class="col-md-4 mt-3"> <div class="hero-sec-adds-4"> <h3>Adds 5</h3> </div> </div> <div class="col-md-8 mt-3"> <div class="row"> <div class="col-md-6 mt-3"> <div class="main-box"> <img class="img-fluid" src="./images/akhirul-akhbar-1.png" alt=""> <div class="main-box-text"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="col-md-6 mt-3"> <div class="main-box"> <img class="img-fluid" src="./images/akhirul-akhbar-2.png" alt=""> <div class="main-box-text"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="col-md-6 mt-3"> <div class="main-box"> <img class="img-fluid" src="./images/akhirul-akhbar-3.png" alt=""> <div class="main-box-text"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="col-md-6 mt-3"> <div class="main-box"> <img class="img-fluid" src="./images/akhirul-akhbar-4.png" alt=""> <div class="main-box-text"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="col-md-12 mt-3"> <div class="d-flex" style="border: 0.5px solid #D0D0D0;"> <p>علاكوش يَشرح لـ"أخبارنا" أسباب استدعاء "أخنوش" النقابات منفردة.. ويُفصّل في مخرجات "لقاء الاثنين"</p> <div> <img class="img-fluid h-100" src="./images/newspaper-10.png" alt=""> </div> </div> </div> </div> </div> </div> </div> </div> <div class="newspaper-4"> <?php echo $__env->make("frontend.desktop.box.news_r04",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="newspaper-6 mt-3" style="background-color: #F9F9F9; padding: 10px 15px;"> <?php echo $__env->make("frontend.desktop.box.news_r06",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="newspaper-7"> <?php echo $__env->make("frontend.desktop.box.news_r08",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="col-md-12 mt-3"> <div class="hero-sec-adds-2"> <h3>Adds-6</h3> </div> </div> <div class="newspaper-5"> <div class="heading mt-4"> <span>مستجدات التعليم</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div> <div class="row"> <div class="col-md-4 mt-3"> <div class="hero-sec-adds-4"> <h3>Adds 5</h3> </div> </div> <?php echo $__env->make("frontend.desktop.box.news_r07",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> </div> </div> <div class="newspaper-8 mt-3"> <div class="row"> <?php echo $__env->make("frontend.desktop.box.news_r10n",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.box.news_r09n",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> </div> <div class="newspaper-7"> <?php echo $__env->make("frontend.desktop.box.news_r11n",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div class="newspaper-9 mt-3"> <div> <div class="row"> <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3"> <div class="heading"> <span>كاريكاتير وصورة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div style="border-right: 1px solid #D8D8D8; padding-right: 10px;"> <div class="main-div mt-3"> <img class="img-fluid" src="./images/newspaper-36.png" alt=""> <div> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> <div> <a href="#"> <button> اقرأ أكثر </button> </a> </div> </div> </div> </div> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3"> <div class="heading"> <span>متفرقات</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div style="border-right: 1px solid #D8D8D8; padding-right: 10px;"> <div class="main-div mt-3"> <img class="img-fluid" src="./images/newspaper-37.png" alt=""> <div> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> <div> <a href="#"> <button> اقرأ أكثر </button> </a> </div> </div> </div> </div> </div> <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-3"> <div class="heading"> <span>مباريات ووظائف</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div class="main-div mt-3"> <img class="img-fluid" src="./images/newspaper-38.png" alt=""> <div> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> <div> <a href="#"> <button> اقرأ أكثر </button> </a> </div> </div> </div> </div> </div> </div> </div> <div class="newspaper-10"> <div class="heading mt-4"> <span>ركن المرأة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div> <div class="row"> <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-3"> <div class="main-sec d-flex justify-content-between align-items-center"> <div> <p>حيل ذهبية تمنع سيلان المكياج وتجعله يدوم طويلاً</p> </div> <div> <img src="./images/newspaper-39.png" alt=""> </div> </div> </div> <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-3"> <div class="main-sec d-flex justify-content-between align-items-center"> <div> <p>حيل ذهبية تمنع سيلان المكياج وتجعله يدوم طويلاً</p> </div> <div> <img src="./images/newspaper-40.png" alt=""> </div> </div> </div> <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-3"> <div class="main-sec d-flex justify-content-between align-items-center"> <div> <p>حيل ذهبية تمنع سيلان المكياج وتجعله يدوم طويلاً</p> </div> <div> <img src="./images/newspaper-41.png" alt=""> </div> </div> </div> </div> </div> </div> <div class="newspaper-6 mt-3"> <div class="heading mt-4"> <span>الأخيرة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div> <div class="row"> <div class="col-12 col-md-12 col-lg-6"> <div class="row"> <div class="col-md-6 mt-3"> <div class="main-box" style="border: none;"> <img class="img-fluid" src="./images/akhitrata-1.png" alt=""> <div class="main-box-text"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="col-md-6 mt-3"> <div class="main-box" style="border: none;"> <img class="img-fluid" src="./images/akhitrata-2.png" alt=""> <div class="main-box-text"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="col-md-6 mt-3"> <div class="main-box" style="border: none;"> <img class="img-fluid" src="./images/akhitrata-3.png" alt=""> <div class="main-box-text"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> <div class="col-md-6 mt-3"> <div class="main-box" style="border: none;"> <img class="img-fluid" src="./images/akhitrata-4.png" alt=""> <div class="main-box-text"> <p>الخطاب الملكي السامي بمناسبة الذكرى 48 للمسيرة الخضراء</p> </div> </div> </div> </div> </div> <div class="col-12 col-md-12 col-lg-6 mt-3"> <div class="news-6-last-img"> <img class="img-fluid" src="./images/akhitrata-5.png" alt=""> <p>الملك: أنبوب غاز المغرب-نيجيريا مشروع للاندماج الجهوي.. ومشاكل الساحل لن تُحلّ بالأبعاد الأمنية فقط</p> </div> </div> </div> </div> </div> </div> </div> <div class="col-md-2 ps-0"> <div class="hero-sec-adds-3"> <h3>Adds-3</h3> </div> </div> </div> </div> </section> <?php $__env->stopSection(); ?> <?php $__env->startSection("styles"); ?> <link media="all" type="text/css" rel="stylesheet" href="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/homepage'.Config::get('app.css_extend').'.css')); ?>"> <?php $__env->stopSection(); ?> <?php $__env->startSection("header_scripts"); ?> <script src="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js?v='.Config::get('app.home_js_version'))); ?>"></script> <script src="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/rotating_headlines.js?v=1')); ?>"></script> <?php $__env->stopSection(); ?>
<?php echo $__env->make("frontend.desktop.layouts.homepage", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_7.4\htdocs\akhbarona\resources\views/frontend/desktop/homepage/default.blade.php ENDPATH**/ ?>