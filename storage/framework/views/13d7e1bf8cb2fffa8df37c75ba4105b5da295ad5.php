<?php if(count($latestNewsArtSw) > 0): ?> <div id="box_category_related" class="box box_white"> <h3 class="box_title title_white">آخر الأخبار</h3> <ul> <?php $__currentLoopData = $latestNewsArtSw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul> </div> <?php endif; ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/box/latest_news_art_sw.blade.php ENDPATH**/ ?>