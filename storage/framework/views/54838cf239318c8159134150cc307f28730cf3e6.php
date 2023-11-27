 <?php $__env->startSection("page-title"); ?><?php echo e($page->title); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-des"); ?><?php echo e($page->title.', '.$setting["VIVVO_GENERAL_META_DESCRIPTION"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-keyword"); ?><?php echo e($page->title); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("seo"); ?> <link rel="canonical" href="<?php echo e(Config::get("app.url")); ?>"/> <meta name="twitter:url" content="<?php echo e(Config::get("app.url")); ?>"/> <meta name="twitter:title" content="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>"/> <meta name="twitter:description" content="<?php echo e($setting["VIVVO_GENERAL_META_DESCRIPTION"]); ?>"/> <meta name="twitter:image" content="<?php echo e($cdnUrl."themes/akhbarona210/img/logo_social.png"); ?>"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("og_image"); ?> <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo e($cdnUrl."themes/akhbarona210/img/logo_social.png"); ?>"/> <meta property="og:image:width" content="800"/> <meta property="og:image:height" content="450"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("header_menu"); ?> <?php echo $__env->make('frontend.desktop.box.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.adv.headline_banner",[$setting], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection("adv_header"); ?> <div class="clearfix"></div> <div class="menu_under_ads"> <?php echo $__env->make("frontend.mobile.adv.top", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <?php $__env->stopSection(); ?> <?php $__env->startSection("content"); ?> <div id="page"> <div class="middle_container"> <div class="mid_part"> <div id="dynamic_box_center"> <div id="box_center_holder"> <?php if($page->title): ?> <ul class="breadcrumb"> <li class="active" style="font-size:18px;"><?php echo e($page->title); ?></li> </ul> <div class="clearfix"></div> <?php endif; ?> <div class="head_lines"> <div class="other_news_01"> <?php echo $page->body; ?> </div> </div> </div> </div> </div> </div> </div> <?php $__env->stopSection(); ?>
<?php echo $__env->make("frontend.mobile.layouts.default", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/mobile/frame/default.blade.php ENDPATH**/ ?>