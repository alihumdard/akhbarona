<div class="white_box"> <div class="white_box_top"></div> <div class="white_box_mid"> <a title="المزيد في أقلام حرة" href="<?php echo e(Common::mobileLink()); ?>writers"><h3 class="box_title title_gray">أقلام حرة</h3></a> <div class="box box_white"> <div id="mainTicker" class="ticker_summary_sw"> <div style="overflow:hidden;" class="scroller"> <?php $__currentLoopData = $newsL2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div id="ticker_<?php echo e($article->id); ?>" class="section row_<?php echo e($index%2); ?>"> <?php if($article->image): ?> <div class="image"> <a href="<?php echo e(Common::article_link($article)); ?>"> <img src="<?php echo e($fileRepo->getSummaryMedium($article->image,true,$article->md5_file)); ?>" width="50" height="65" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>" /><br /> </a> </div> <?php endif; ?> <h3><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></h3> <div class="story_stamp_sw"> <?php if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR"]): ?> <span class="story_author_sw"><?php echo e($article->author); ?></span> <?php endif; ?> </div> <div class="clearer"> </div> </div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </div> </div> </div> </div> <div class="white_box_bottom"></div> </div><?php /**PATH C:\xampp_7.4\htdocs\akhabarona\resources\views/frontend/desktop/box/news_l2.blade.php ENDPATH**/ ?>