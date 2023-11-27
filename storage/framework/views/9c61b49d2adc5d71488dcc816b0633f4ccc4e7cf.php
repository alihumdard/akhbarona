 <?php $__env->startSection("page-title"); ?><?php echo e($category->category_name); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-des"); ?><?php echo e($category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-keyword"); ?><?php echo e($category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("rss"); ?> <link rel="alternate" type="application/rss+xml" title="<?php echo e($category->category_name); ?>" href="<?php echo e(\App\Helper\Common::cat_link(null,"rss",$category->id)); ?>" /> <link rel="alternate" type="application/rss+xml" title="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>" href="<?php echo e(Config::get("app.url")); ?>mobile/feed/index.rss" /> <?php $__env->stopSection(); ?> <?php $__env->startSection("seo"); ?> <link rel="canonical" href="<?php echo e($canonical); ?>"/> <meta name="twitter:url" content="<?php echo e($canonical); ?>"/> <meta name="twitter:title" content="<?php echo e($category->category_name); ?>"/> <meta name="twitter:description" content="<?php echo e($category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]); ?>"/> <meta name="twitter:image" content="<?php echo e($cdnUrl."themes/akhbarona210/img/logo_social.png"); ?>"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("og_image"); ?> <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo e($cdnUrl."themes/akhbarona210/img/logo_social.png"); ?>"/> <meta property="og:url" content="<?php echo e($canonical); ?>"/> <meta property="og:image:width" content="800"/> <meta property="og:image:height" content="450"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("adv_header"); ?> <div class="menu_under_ads"> <?php echo $__env->make("frontend.mobile.adv.top", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <?php $__env->stopSection(); ?> <?php $__env->startSection("content"); ?> <?php if($category->id == 7): ?> <?php echo $__env->make("frontend.mobile.category.sports",[$fileRepo,$cdnUrl,$setting,$category,$page,$arrData,$perPage,$popularBox,$parent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php else: ?> <?php echo $__env->make("frontend.mobile.category.category",[$fileRepo,$cdnUrl,$setting,$category,$page,$arrData,$perPage,$popularBox,$parent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make("frontend.mobile.layouts.default", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/mobile/category/default.blade.php ENDPATH**/ ?>