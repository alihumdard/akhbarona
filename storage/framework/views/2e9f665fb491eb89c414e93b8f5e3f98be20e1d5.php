<div id="comment_form_holder"> <h4 class="title_comments_n">هل ترغب بالتعليق على الموضوع؟</h4> <div class="border_title_comments_n"></div> <div id="comment_dump_container" class="result"> </div> <form method="post" id="comment_form" onsubmit="return updateComments();"> <input type="hidden" name="action" value="comment" /> <input type="hidden" name="cmd" value="add" /> <input type="hidden" name="article_id" value="<?php echo e($id); ?>" /> <div id="post-reply" class="box"> <div id="comment_right"> <div class="form_line"> <label>الاسم: </label> <div class="formElement"> <input name="author" maxlength="50" class="text default_fields" type="text" value="" required="required"/> </div> </div> <div class="form_line"> <label>عنوان التعليق: </label> <div class="formElement"> <input name="www" maxlength="100" class="text default_fields" type="text" value="" required="required" /> </div> </div> </div> <div id="comment_left" class="border_comments_n"> التعليقات المنشورة لا تعبر بالضرورة عن رأي الموقع<br /><br /> من شروط النشر: عدم الإساءة للكاتب أو للأشخاص أو للمقدسات </div> <div class="clearer"> </div> <div class="form_line"> <label><?php echo e(Config::get("site.lang.LNG_ADD_COMMENTS")); ?>:</label> <div class="formElement"> <textarea required="required" minlength="30" maxlength="1000" class="add_comment default_fields" name="description" rows="7" cols="40" onfocus="this.value='';this.onfocus = null;"> </textarea> </div> </div> <div class="form_line"> <label><!-- --></label> <div class="formElement_sw"> <input type="submit" class="button_sw" value="<?php echo e(Config::get("site.lang.LNG_ADD_COMMENTS_BUTTON")); ?>" /> </div> </div> </div> </form> </div><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/box/comments_add.blade.php ENDPATH**/ ?>