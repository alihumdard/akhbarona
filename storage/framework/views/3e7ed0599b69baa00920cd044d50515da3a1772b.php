<div class="footer_banner"> <?php echo $__env->make("frontend.desktop.adv.footer_top", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <div id="footer"> <?php echo $__env->make("frontend.desktop.box.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <script> function searchKeyword(id) { var commentParam = $(id).serialize(true); new Ajax.Request( '<?php echo e(route("frontend.search")); ?>', { parameters: commentParam, method:'post', evalScripts: true, onSuccess: function(response) { window.location.href = response.responseText; } }); return false; } </script><?php /**PATH C:\xampp_7.4\htdocs\akhabarona\resources\views/frontend/desktop/layouts/footer.blade.php ENDPATH**/ ?>