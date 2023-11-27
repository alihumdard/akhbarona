<?php if($total > 0): ?> <div id="box_pagination"> <?php if($total > $perPage): ?> <?php $numberPage = ceil($total/$perPage)?>
 <span class="pagination"> <?php if(($currentPage-10) > 0): ?> <?php
                    $routeParam["page"] = $currentPage-10;
                    ?>
 <a href="<?php echo e(Common::link($routeName,$routeParam)); ?>" class="page_groups"><img src="<?php echo e($fileRepo->getMobileUrl("img/pagination_first.gif")); ?>" alt="first" /></a> <?php endif; ?> <?php if($currentPage > 1): ?> <?php $routeParam["page"] = $currentPage-1;?>
 <a href="<?php echo e(Common::link($routeName,$routeParam)); ?>" class="page_groups"><img src="<?php echo e($fileRepo->getMobileUrl("img/pagination_back.gif")); ?>" alt="back" /></a> <?php endif; ?> <?php
                $rangePage = 10;
                $startPage = 1;
                $endPage = $rangePage;
                if($currentPage > 1 && $currentPage%$rangePage == 0) {
                    $numRange = $currentPage/$rangePage;
                    $startPage = ($numRange)*$rangePage;
                    $endPage = ($numRange+1)*$rangePage;
                }elseif($currentPage > $rangePage) {
                    $numRange = ceil($currentPage/$rangePage);
                    $startPage = ($numRange-1)*$rangePage;
                    $endPage = $numRange*$rangePage;
                }
                if($endPage > $numberPage) {
                    $endPage = $numberPage;
                }
                ?>
 <?php for($i=$startPage; $i<= $endPage;$i++): ?> <?php $routeParam["page"] = $i;?>
 <?php if($i != $currentPage): ?> <a href="<?php echo e(Common::link($routeName,$routeParam)); ?>"><?php echo e($i); ?></a> <?php else: ?> <span class="page_active"><?php echo e($i); ?></span> <?php endif; ?> <?php endfor; ?> <?php if($currentPage < $numberPage ): ?> <?php $routeParam["page"] = $currentPage+1;?>
 <a href="<?php echo e(Common::link($routeName,$routeParam)); ?>" class="page_groups"><img src="<?php echo e($fileRepo->getMobileUrl("img/pagination_next.gif")); ?>" alt="next" /></a> <?php endif; ?> <?php if(($currentPage+10) < $numberPage): ?> <?php $routeParam["page"] = $currentPage+10;?>
 <a href="<?php echo e(Common::link($routeName,$routeParam)); ?>" class="page_groups"><img src="<?php echo e($fileRepo->getMobileUrl("img/pagination_last.gif")); ?>" alt="last" /></a> <?php endif; ?> </span> <?php endif; ?> <?php echo e(Config::get("site.lang.LNG_TOTAL")); ?>: <span class="pagination_total"> <?php echo e($total); ?> </span> | <?php echo e(Config::get("site.lang.LNG_DISPLAYING")); ?>: <span class="pagination_total"> <?php echo e(($perPage*($currentPage-1)+1).' - '.(($perPage*$currentPage) > $total?$total:($perPage*$currentPage))); ?> </span> </div> <?php endif; ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/mobile/system/box_default/box_pagination.blade.php ENDPATH**/ ?>