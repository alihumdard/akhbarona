 <?php $__env->startSection("page-title"); ?><?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-des"); ?><?php echo e($setting["VIVVO_GENERAL_META_DESCRIPTION"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-keyword"); ?><?php echo e($setting["VIVVO_GENERAL_META_KEYWORDS"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("rss"); ?> <link rel="alternate" type="application/rss+xml" title="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>" href="<?php echo e(Config::get("app.url")); ?>feed/index.rss" /> <?php $__env->stopSection(); ?> <?php $__env->startSection("seo"); ?> <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo e(Config::get("app.url")); ?>mobile" hreflang="en" /> <link rel="canonical" href="<?php echo e(Config::get("app.url")); ?>"/> <meta name="twitter:url" content="<?php echo e(Config::get("app.url")); ?>"/> <meta name="twitter:title" content="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>"/> <meta name="twitter:description" content="<?php echo e($setting["VIVVO_GENERAL_META_DESCRIPTION"]); ?>"/> <meta name="twitter:image" content="<?php echo e($cdnUrl."themes/akhbarona210/img/logo_social.png"); ?>"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("og_image"); ?> <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo e($cdnUrl."themes/akhbarona210/img/logo_social.png"); ?>"/> <meta property="og:url" content="<?php echo e(Config::get("app.url")); ?>"/> <meta property="og:image:width" content="800"/> <meta property="og:image:height" content="450"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("header_menu"); ?> <?php echo $__env->make('frontend.desktop.box.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.adv.headline_banner", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection("content"); ?> <div id="container"> <?php echo $__env->make("frontend.desktop.adv.ad_tabs_home", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.box.ticker_typer_homepage",[$arrTicker], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <div id="content"> <div id="dynamic_box_center"> <div id="box_center_holder"> <div id="content_features" class="features_equal_default"> <div id="content_features_left"> <?php echo $__env->make("frontend.desktop.box.latest_news_bh_sw",[$latestNewsBhSw,$fileRepo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div id="content_features_right"> <?php echo $__env->make("frontend.desktop.box.fancy_headlines",[$fancyHeadlines,$fileRepo,$setting], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> </div> <?php echo $__env->make("frontend.desktop.box.column_center",$columnCenter, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> </div> <div id="dynamic_box_right"> <div id="box_right_holder"> <?php echo $__env->make("frontend.desktop.box.column_left",$columnLeft, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> </div> <div class="clearFix"></div> </div> <?php $__env->stopSection(); ?> <?php $__env->startSection("styles"); ?> <link media="all" type="text/css" rel="stylesheet" href="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/homepage'.Config::get('app.css_extend').'.css')); ?>"> <?php $__env->stopSection(); ?> <?php $__env->startSection("header_scripts"); ?> <script src="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js?v='.Config::get('app.home_js_version'))); ?>"></script> <script src="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/rotating_headlines.js?v=1')); ?>"></script> <?php $__env->stopSection(); ?>
<?php echo $__env->make("frontend.desktop.layouts.homepage", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/homepage/default.blade.php ENDPATH**/ ?>