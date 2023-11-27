<?php if(count($newsR10n) > 0): ?> <div id="category_news_box" > <div class="main_news_box_row"> <a title="المزيد في علوم وتكنولوجيا" href="<?php echo e(Common::mobileLink()); ?>technology"><h3 class="box_title_two title_two">علوم وتكنولوجيا</h3></a> </div> <div id="latest_news_two" class="box_two box_white_two"> <?php $article = $newsR10n[0];unset($newsR10n[0])?>
 <div class="short"> <div class="short_holder"> <?php if($article->image): ?> <div class="image"> <a href="<?php echo e(Common::article_link($article)); ?>"> <img src="<?php echo e($fileRepo->getMedium($article->image,true,$article->md5_file)); ?>" width="305" height="200" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>" /><br /> </a> </div> <?php endif; ?> </div> <h2 class="article_title"><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></h2> <p> <?php echo e($article->abstract?$article->abstract:Common::subWords($article->body,25)); ?> <?php if($article->body): ?>...<?php endif; ?> <?php if(!$article->link): ?> <?php if($article->body): ?> <a href="<?php echo e(Common::article_link($article)); ?>"> <?php echo e(Config::get("site.lang.LNG_FULL_STORY")); ?></a> <?php endif; ?> <?php else: ?> <a class="visit" href="<?php echo e($article->link); ?>"><img src="<?php echo e($fileRepo->getDesktopUrl("img/external.png")); ?>" alt="<?php echo e(Config::get("site.lang.LNG_VISIT_WEBSITE")); ?>"/></a> <?php endif; ?> </p> </div> <ul> <?php $__currentLoopData = $newsR10n; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li> <a href="<?php echo e(Common::article_link($article)); ?>"> <?php echo e($article->title); ?> </a> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <div class="more_sw"><a class="more_sw" href="<?php echo e(Common::mobileLink()); ?>technology"></a></div> <div class="clearer"> </div> </ul> </div> </div> <?php endif; ?><?php /**PATH C:\xampp_7.4\htdocs\akhbarona\resources\views/frontend/desktop/box/news_r10n.blade.php ENDPATH**/ ?>