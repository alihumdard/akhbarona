<h1>Section 11</h1> <div class="box1 box_white1"> <div id="category_news_box" > <div class="main_news_box_row"> <a title="المزيد في مباريات ووظائف" href="<?php echo e(Common::mobileLink()); ?>contest"><h3 class="box_title_contest title_contest">مباريات ووظائف</h3></a> </div> <div id="latest_news_two" class="box_two box_white_two"> <?php $__currentLoopData = $newsL8; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="short"> <div class="short_holder"> <?php if($article->image): ?> <div class="image"> <a href="<?php echo e(Common::article_link($article)); ?>"> <img src="<?php echo e($fileRepo->getLarge($article->image,true,$article->md5_file)); ?>" width="150" height="110" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>" /><br /> </a> </div> <?php endif; ?> <h2 class="article_title_two_one"><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></h2> </div> <p> <?php echo e($article->abstract?$article->abstract:Common::subWords($article->body,25)); ?> <?php if($article->body): ?>...<?php endif; ?> <?php if(!$article->link): ?> <?php if($article->body): ?> <span class="mor_full"><a href="<?php echo e(Common::article_link($article)); ?>"> <?php echo e(Config::get("site.lang.LNG_FULL_STORY")); ?></a></span> <?php endif; ?> <?php else: ?> <a class="visit" href="<?php echo e($article->link); ?>"><img src="<?php echo e($fileRepo->getDesktopUrl("img/external.png")); ?>" alt="<?php echo e(Config::get("site.lang.LNG_VISIT_WEBSITE")); ?>"/></a> <?php endif; ?> </p> </div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </div> </div> </div><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/box/news_l8.blade.php ENDPATH**/ ?>