<h1>Section 2</h1> <div id="headline"> <div id="rotating_headlines" class="box_headline"> <?php $__currentLoopData = $fancyHeadlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div id="rotating_headlines_<?php echo e($index); ?>" class="headline_article_holder" style="<?php echo e($index != 0?"display:none;":""); ?>"> <div class="headline_image"> <?php if($article->image): ?> <div id="headline_image_big"> <a href="<?php echo e(Common::article_link($article)); ?>"> <img id="defaultDemo" src="<?php echo e($fileRepo->getLarge($article->image,true,$article->md5_file)); ?>" width="460" height="312" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>" /> </a> </div> <?php endif; ?> <div id="rotating_headlines_article_<?php echo e($index); ?>" class="headline_short"> <h1 class="article_title_fancy"><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></h1> <?php echo e($article->abstract?$article->abstract:Common::subWords($article->body,25)); ?> </div> </div> </div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <div class="player"> <ul id="rotating_headlines_player"> <?php $__currentLoopData = $fancyHeadlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li> <a href="#rotating_headlines_<?php echo e($index); ?>"> <img src="<?php echo e($fileRepo->getSmall($article->image,true,$article->md5_file)); ?>" width="45" height="45" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>" /> </a> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul> <div class="clearer"> </div> </div> </div> </div> <script type="text/javascript"> var rotating_headlines_tabs = new vivvoRotatingHeadlines('rotating_headlines', <?php echo e(isset($setting["VIVVO_MODULES_HEADLINES_ROTATION_TIME"])?$setting["VIVVO_MODULES_HEADLINES_ROTATION_TIME"]:8); ?>); </script><?php /**PATH C:\xampp\htdocs\akhbarona\resources\views/frontend/desktop/box/fancy_headlines.blade.php ENDPATH**/ ?>