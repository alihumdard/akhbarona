<?php echo $__env->make("frontend.desktop.adv.mega_970_homepage", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <div id="content_sw"> <ul class="ticker"> <?php $__currentLoopData = $arrTicker; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$ticker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li class="category" style="display: none"> <strong><a href="<?php echo e(Common::link("frontend.category.index",[$ticker[0]->slug,1])); ?>"><?php echo e($ticker[0]->category_name); ?></a></strong> <ul> <?php $__currentLoopData = $ticker; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><a href="<?php echo e(Common::article_link($tk)); ?>"><?php echo e(($tk->title)); ?></a></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul> </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul> <script type="text/javascript"> var tickers = document.querySelectorAll('ul.ticker'); new vivvoTickerTyper(tickers[0]); </script> </div><?php /**PATH C:\xampp_7.4\htdocs\akhbarona\resources\views/frontend/desktop/box/ticker_typer_homepage.blade.php ENDPATH**/ ?>