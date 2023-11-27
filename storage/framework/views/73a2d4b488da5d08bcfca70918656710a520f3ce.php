<?php
$startIndex = ($commentPages["currentPage"]-1)*$commentPages["perPage"]+1;
?>
<?php $__currentLoopData = $comments['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div class="comment_holder"> <a name="comment_<?php echo e($comment->id); ?>"> </a> <div class="comment_body"> <div class="comment_header"> <?php echo e($startIndex++); ?> - <?php echo e($comment->author); ?> </div> <div class="comment_title"> <?php echo e($comment->www); ?> </div> <div class="comment_text"> <?php echo e($comment->description); ?> </div> <div class="comment_actions"> <a href="javascript:voteComment(<?php echo e($comment->id); ?>, 1);"><img src="<?php echo e($fileRepo->getMobileUrl("img/thumbs_upx.gif")); ?>" title="<?php echo e(Config::get("site.lang.LNG_COMMENTS_THUMB_UP")); ?>" alt="<?php echo e(Config::get("site.lang.LNG_COMMENTS_THUMB_UP")); ?>" /></a> <a href="javascript:voteComment(<?php echo e($comment->id); ?>, -1);"><img src="<?php echo e($fileRepo->getMobileUrl("img/thumbs_downx.gif")); ?>" title="<?php echo e(Config::get("site.lang.LNG_COMMENTS_THUMB_DOWN")); ?>" alt="<?php echo e(Config::get("site.lang.LNG_COMMENTS_THUMB_DOWN")); ?>" /></a> <div id="comment_vote_<?php echo e($comment->id); ?>" class="result"> <?php echo e($comment->vote); ?> </div> <?php if(isset($setting["VIVVO_EMAIL_ENABLE"]) && $setting["VIVVO_EMAIL_ENABLE"] && $isAdmin): ?> <?php if(isset($setting["VIVVO_COMMENTS_REPORT_INAPPROPRIATE"]) && $setting["VIVVO_COMMENTS_REPORT_INAPPROPRIATE"]): ?> <span id="comment_report_<?php echo e($comment->id); ?>"> <a href="javascript:reportComment(<?php echo e($comment->id); ?>);"> <img src="<?php echo e($fileRepo->getDesktopUrl("img/comment_report.gif")); ?>" title="<?php echo e(Config::get("site.lang.LNG_COMMENTS_REPORT_INAPPROPRIATE")); ?>" alt="<?php echo e(Config::get("site.lang.LNG_COMMENTS_REPORT_INAPPROPRIATE")); ?>" /> </a> </span> <?php endif; ?> <?php endif; ?> <span class="comment_stamp"> <?php echo e(\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$comment->create_dt,isset($setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])?$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"]:null)->format("Y/m/d - h:i")); ?> </span> </div> </div> </div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <div id="new_comment_holder"> </div> <div id="box_pagination"> <?php $j = 0;?>
 <?php
    $numberPage = $commentPages["numPage"];
    $currentPage = $commentPages["currentPage"];
    $rangePage = 5;
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
 <?php if($commentPages["numPage"] > 1): ?> <span class="pagination"> <?php if($commentPages["currentPage"] > 1): ?> <a href="javascript:loadCommentsPage(<?php echo e($commentPages["currentPage"]); ?>-1);"><img src="<?php echo e($fileRepo->getDesktopUrl("img/pagination_back.gif")); ?>" alt="back" /></a> <?php endif; ?> <?php for($i=$startPage;$i<=$endPage;$i++): ?> <?php if($i != $commentPages["currentPage"]): ?> <a href="javascript:loadCommentsPage(<?php echo e($i); ?>);"><?php echo e($i); ?></a> <?php else: ?> <?php echo e($i); ?> <?php endif; ?> <?php $j++; if($j > 5) {break;}?>
 <?php endfor; ?> <?php if($commentPages["currentPage"] < $commentPages["numPage"]): ?> <a href="javascript:loadCommentsPage(<?php echo e($commentPages["currentPage"]); ?>+1);"><img src="<?php echo e($fileRepo->getDesktopUrl("img/pagination_next.gif")); ?>" alt="next" /></a> <?php endif; ?> </span> <?php endif; ?> <?php echo e(Config::get("site.lang.LNG_TOTAL")); ?>: <span class="pagination_total"> <?php echo e($comments["total"] > 0?$comments["total"]:''); ?> </span> | <?php echo e(Config::get("site.lang.LNG_DISPLAYING")); ?>: <span class="pagination_total"> <?php echo e($comments["total"] > 0?($commentPages["perPage"]*($commentPages["currentPage"]-1)+1).' - '.(($commentPages["perPage"]*$commentPages["currentPage"]) > $comments["total"]?$comments["total"]:($commentPages["perPage"]*$commentPages["currentPage"])):''); ?> </span> </div><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/mobile/box/list_comment.blade.php ENDPATH**/ ?>