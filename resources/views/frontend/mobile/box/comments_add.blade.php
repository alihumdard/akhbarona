<div id="comment_form_holder">
    <h4 class="title_comments">هل ترغب بالتعليق على الموضوع؟</h4>
    <div id="comment_dump_container" class="result"> </div>
    <form method="post" id="comment_form" onsubmit="return updateComments();">
        <input type="hidden" name="action" value="comment" />
        <input type="hidden" name="cmd" value="add" />
        <input type="hidden" name="article_id" value="{{$id}}" />
        <div id="post-reply" class="box">
            <div class="form_line">
                <label>الاسم: </label>
                <div class="formElement">
                    <input name="author" maxlength="50" class="text default_fields" type="text" value="" required="required"/>
                </div>
            </div>
            <div class="form_line">
                <label>عنوان التعليق: </label>
                <div class="formElement">
                    <input name="www" maxlength="100" class="text default_fields" type="text" value="" required="required" />
                </div>
            </div>
            <div class="form_line">
                <label>{{Config::get("site.lang.LNG_ADD_COMMENTS")}}:</label>
                <div class="formElement">
                    <textarea required="required" minlength="30" maxlength="1000" class="add_comment default_fields" name="description" rows="7" cols="40" onfocus="this.value='';this.onfocus = null;"> </textarea>
                </div>
            </div>
            <div class="form_line">
                <label><!-- --></label>
                <div class="formElement">
                    <input type="submit" class="button" value="{{Config::get("site.lang.LNG_ADD_COMMENTS_BUTTON")}}" />
                </div>
            </div>
        </div>
    </form>
</div>
