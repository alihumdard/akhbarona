<?php if(count($relatedNews) > 0): ?> <div id="box_related_news" class="box box_white"> <h3 class="box_title title_white"><?php echo e(Config::get("site.lang.LNG_RELATED_NEWS")); ?></h3> <ul> <?php $__currentLoopData = $relatedNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li> <a href="<?php echo e(Common::article_link($article)); ?>"> <?php echo e($article->title); ?> </a> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul> </div> <?php endif; ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/box/related_news.blade.php ENDPATH**/ ?>