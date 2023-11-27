﻿<?php
$menus = \App\Helper\Common::menus();
$total = count($menus);
$setting = \App\Models\Config::getAllValue();
$mainUrl = Common::mobileLink();
?>
<div class="row"> <div class="col-md-2"></div> <div class="col-md-8"> <div class="newspaper-sec"> <footer class="footer-sec mt-3"> <div> <div class="row"> <div class="col-12 col-sm-12 col-md-6 col-lg-3"> <h4>أخبارنا</h4> <div dir="rtl" style="border-right: 1px solid #5B728D;"> <ul class="footer-links"> <li> <a href="<?php echo e($mainUrl); ?>submit.html">للنشر في الموقع</a> </li> <li> <a href="<?php echo e($mainUrl); ?>team.html">فريق العمل</a> </li> <li> <a href="<?php echo e($mainUrl); ?>conditions.html">شروط استخدام الموقع</a> </li> <li> <a href="<?php echo e($mainUrl); ?>contact/">إتصل بنا</a> </li> </ul> </div> </div> <div class="col-12 col-sm-12 col-md-6 col-lg-6"> <div> <h4>الأقسام</h4> <div class="row"> <div class="col-md-4"> <div dir="rtl"> <ul class="footer-links"> <?php if($total): ?> <?php $__currentLoopData = $menus->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li> <a href="<?php echo e(Common::link("frontend.category.index",[$menu->sefriendly,1])); ?>"> <?php echo e($menu->category_name); ?> </a> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> </ul> </div> </div> <div class="col-md-4"> <div dir="rtl"> <ul class="footer-links"> <?php $__currentLoopData = $menus->slice(3, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li> <a href="<?php echo e(Common::link("frontend.category.index",[$menu->sefriendly,1])); ?>"> <?php echo e($menu->category_name); ?> </a> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul> </div> </div> <div class="col-md-4"> <div dir="rtl" style="border-right: 1px solid #5B728D;"> <ul class="footer-links"> <?php $__currentLoopData = $menus->slice(7, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li> <a href="<?php echo e(Common::link("frontend.category.index",[$menu->sefriendly,1])); ?>"> <?php echo e($menu->category_name); ?> </a> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul> </div> </div> </div> </div> </div> <div class="col-12 col-sm-12 col-md-12 col-lg-3"> <div class="footer-social-links"> <a href="<?php echo e($mainUrl); ?>"><img class="img-fluid" src="<?php echo e(Config::get("app.cdn_url")); ?>themes/akhbarona210/img/footer_logo.png" alt="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>" title="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>" /></a> <h3 class="">تابعنا:</h3> <div class=""> <a href="#"><img src="./images/top-facebook.png" alt=""></a> <a href="#"><img src="./images/top-instagram.png" alt=""></a> <a href="#"><img src="./images/top-twitter.png" alt=""></a> <a href="#"><img src="./images/top-youbute.png" alt=""></a> </div> </div> </div> <div class="col-md-12"> <div class="contact-btn mt-3"> <h5>حمل تطيق أخبارنا:</h5> <a href="#"> <img class="img-fluid" src="./images/playstore.png" alt=""> </a> &nbsp; <a href="#"> <img class="img-fluid" src="./images/appstore.png" alt=""> </a> &nbsp; <a href="#"> <img class="img-fluid" src="./images/appgallery.png" alt=""> </a> </div> </div> </div> </div> <div class="copyright text-center mt-3"> <p class="mb-0">جميع الحقوق محفوظة أخبارنا المغربية © <?php echo e(date("Y")); ?> - 2011</p> </div> </footer> </div> </div> <div class="col-md-2"></div> </div> <script> function bookmarksite(url){ var objTitle = document.getElementsByTagName("title"); var title = objTitle[0]; if (window.sidebar) { window.sidebar.addPanel(title, url, ""); } else if(window.opera && window.print) { var elem = document.createElement('a'); elem.setAttribute('href',url); elem.setAttribute('title',title); elem.setAttribute('rel','sidebar'); elem.click(); } else if(document.all) { window.external.AddFavorite(url, title); } } </script><?php /**PATH C:\xampp_7.4\htdocs\akhbarona\resources\views/frontend/desktop/box/footer.blade.php ENDPATH**/ ?>