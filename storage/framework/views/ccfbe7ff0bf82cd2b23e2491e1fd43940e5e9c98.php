<div id="category_news_box" > <div class="main_news_box_row"> <a title="المزيد في ثقافة وفنون" href="<?php echo e(Common::mobileLink()); ?>culture"><h3 class="box_title_two_art title_two_art">ثقافة وفنون</h3></a> </div> <div id="latest_news_two" class="box_two box_white_two"> <ul> <?php $__currentLoopData = $newsR11n; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="short_social"> <div class="short_holder_social"> <?php if($article->image): ?> <div class="image"> <a href="<?php echo e(Common::article_link($article)); ?>"> <img src="<?php echo e($fileRepo->getMedium($article->image,true,$article->md5_file)); ?>" width="191" height="140" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>" /><br /> </a> </div> <?php endif; ?> <div class="clearer"> </div> <h2 class="article_title_social"><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></h2> </div> </div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <div class="clearer"> </div> </ul> </div> </div><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/box/news_r11n.blade.php ENDPATH**/ ?>