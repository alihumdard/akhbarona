<div class="category_headline"> <?php if($article->image): ?> <div class="image"> <a href="<?php echo e(Common::article_link($article)); ?>"> <img src="<?php echo e($fileRepo->getSmall($article->image,true,$article->md5_file)); ?>" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>" /> </a><br /> </div> <?php endif; ?> <h1 class="article_title"><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></h1> <p> <?php echo e($article->abstract?$article->abstract:Common::subWords($article->body,25)); ?> <?php if($article->body): ?>...<?php endif; ?> <?php if(!$article->link): ?> <?php if($article->body): ?> <a href="<?php echo e(Common::article_link($article)); ?>"> <?php echo e(Config::get("site.lang.LNG_FULL_STORY")); ?></a> <?php endif; ?> <?php else: ?> <a class="visit" href="<?php echo e($article->link); ?>"><img src="<?php echo e($fileRepo->getDesktopUrl("img/external.png")); ?>" alt="<?php echo e(Config::get("site.lang.LNG_VISIT_WEBSITE")); ?>"/></a> <?php endif; ?> </p> <div class="clearer"> </div> </div><?php /**PATH C:\xampp_7.4\htdocs\akhabarona\resources\views/frontend/desktop/summary/vertical.blade.php ENDPATH**/ ?>