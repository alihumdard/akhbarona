<div id="latest_news_video"> <a title="المزيد في شاشة أخبارنا" href="<?php echo e(Config::get("app.url")); ?>videos"><h3 class="box_title title_gray">شاشة أخبارنا</h3></a> <div id="latest_news_video" class="box_video box_white_video"> <?php $__currentLoopData = $newsL1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="short_video"> <div class="short_holder_video"> <?php if($article->image): ?> <a href="<?php echo e(Common::article_link($article)); ?>"> <img src="<?php echo e($fileRepo->getMedium($article->image,true,$article->md5_file)); ?>" width="140" height="90" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>"/><br/> </a> <?php endif; ?> <h2 class="article_title_video"><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a> </h2> </div> </div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <div class="clearer"></div> </div> </div><?php /**PATH C:\xampp_7.4\htdocs\akhabarona\resources\views/frontend/desktop/box/news_l1.blade.php ENDPATH**/ ?>