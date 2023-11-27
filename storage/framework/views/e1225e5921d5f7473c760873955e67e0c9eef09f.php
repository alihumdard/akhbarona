<?php if(count($newL2A)): ?> <div class="white_box"> <div class="white_box_top"></div> <div class="white_box_mid"> <a title="المزيد في أقلام حرة" href="<?php echo e(Config::get("app.url")); ?>writers"><h3 class="box_title title_gray">أقلام حرة</h3></a> <div class="box box_white"> <div id="mainTicker" class="ticker_summary_sw"> <div style="overflow:hidden;" class="scroller"> <?php $__currentLoopData = $newL2A; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div id="ticker_{article.id}" class="section row_<?php echo e($index%2); ?>"> <?php echo $__env->make("frontend.desktop.box.article_image",[$article,$fileRepo,"width"=>50,"height"=>65,"fnc"=>"getSummaryMedium"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <h3><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></h3> <div class="story_stamp_sw"> <?php if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR"]): ?> <?php if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"]): ?> <span class="story_author_sw"><a href="#"><?php echo e($article->author); ?></a></span> <?php else: ?> <span class="story_author_sw"><?php echo e($article->author); ?></span> <?php endif; ?> <?php endif; ?> </div> <div class="clearer"> </div> </div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </div> </div> <script type="text/javascript"> var mainTicker = new vivvoTicker('mainTicker'); </script> </div> </div> <div class="white_box_bottom"></div> </div> <?php endif; ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/box/news_l2_a.blade.php ENDPATH**/ ?>