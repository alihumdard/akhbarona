<div class="heading mt-4"> <span>أقلام حرة</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866"></rect> <rect width="10" height="25" fill="#C2111E"></rect> </svg> </div> <hr class="red-line"> <div> <div class="row"> <?php $__currentLoopData = $newsL2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3"> <div class="news-main-box d-flex" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px; border-bottom-left-radius: 44px; border-top-left-radius: 44px; overflow: hidden;"> <div style="flex: 1;"> <p><a style="color:white; text-decoration:none;" href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></p> </div> <?php if($article->image): ?> <div style="flex: 1; display: flex; align-items: center; justify-content: flex-end;"> <a href="<?php echo e(Common::article_link($article)); ?>"> <div style="height: 100px; width: 100px; overflow: hidden; border-radius: 50%;"> <img class="image-fluid" src="<?php echo e($fileRepo->getSummaryMedium($article->image,true,$article->md5_file)); ?>" alt="<?php echo e($article->image_caption?$article->image_caption:$article->title); ?>" style="height: 100%; width: 100%; object-fit: cover;"> </div> </a> </div> <?php endif; ?> </div> </div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </div> </div><?php /**PATH C:\xampp_7.4\htdocs\akhbarona\resources\views/frontend/desktop/box/news_l2.blade.php ENDPATH**/ ?>