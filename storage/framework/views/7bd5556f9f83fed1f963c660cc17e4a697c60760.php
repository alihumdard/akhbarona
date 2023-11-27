<?php
// get router
$routeCurrent = Route::getCurrentRoute()->getActionName();
$segment = \Request::segment(1);
$arrControllers = explode("\\",$routeCurrent);
$arrControllers = explode('@',$arrControllers[count($arrControllers) - 1]);
$controllerCurrent = $arrControllers[0];
$actionCurrent = $arrControllers[1];
$menus = \App\Helper\Common::menus();
$total = count($menus);
$setting = \App\Models\Config::getAllValue();
?>
<div id="header"> <div class="header_image"> <div id="containers"> <?php echo $__env->make("frontend.desktop.box.top_bar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <a href="<?php echo e(Common::mobileLink()); ?>"><img src="<?php echo e(Config::get("app.cdn_url")); ?>themes/akhbarona210/img/logo.png" alt="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>" title="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>" /></a> <div class="banner"><?php echo $__env->make("frontend.desktop.adv.header_banner", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div> <div class="clearer"> </div> <div id="mainNav"> <ul id="menu_main" class="menu"> <?php if($total > 0): ?> <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li <?php if($controllerCurrent == 'HomeController'): ?> <?php if($actionCurrent == 'page' && strpos($menu->redirect,"advertising") !== false): ?> class="selected" <?php elseif($actionCurrent == 'desktop' && $menu->redirect && strpos($menu->redirect,"advertising") === false): ?> class="selected" <?php endif; ?> <?php elseif($controllerCurrent == 'CategoryController'): ?> <?php if($segment == $menu->sefriendly): ?> class="selected" <?php endif; ?> <?php endif; ?> > <a href="<?php echo e($menu->redirect?$menu->redirect:Common::link("frontend.category.index",[$menu->sefriendly,1])); ?>"> <?php echo e($menu->category_name); ?> </a> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> </ul> </div> </div> </div> <div class="clearer"> </div> </div><?php /**PATH C:\xampp_7.4\htdocs\akhabarona\resources\views/frontend/desktop/box/header.blade.php ENDPATH**/ ?>