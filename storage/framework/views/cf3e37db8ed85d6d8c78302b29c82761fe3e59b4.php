<?php if(count($newsR02) > 0): ?> <div class="row"> <div class="col-md-2"></div> <div class="col-md-8"> <div class="newspaper-4"> <div class="heading mt-4"> <a title="المزيد في سياسة" href="<?php echo e(Common::mobileLink()); ?>politic" style="text-decoration: none; color: black;"><span style="padding:10px 15px;background: #f5f8f9; font-size: 20px; font-weight: 700;">سياسة</span></a><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47" viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none"> <rect y="25" width="10" height="25" fill="#2E4866" /> <rect width="10" height="25" fill="#C2111E" /> </svg> </div> <hr class="red-line"> <div class="row"> <?php $article = $newsR02[0];unset($newsR02[0]); ?>
 <?php foreach($newsR02 as $index=>$article) { ?>
 <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-3"> <div class="main-box"> <?php if($article->image): ?> <a href="<?php echo e(Common::article_link($article)); ?>"> <img class="img-fluid" src="<?php echo e($fileRepo->getLarge($article->image,true,$article->md5_file)); ?>" alt=""> </a> <?php endif; ?> <div class="main-box-text"> <p><a href="<?php echo e(Common::article_link($article)); ?>"><?php echo e($article->title); ?></a></p> </div> </div> </div> <?php } ?>
 </div> </div> </div> <div class="col-md-2"></div> </div> <?php endif; ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/box/news_r02.blade.php ENDPATH**/ ?>