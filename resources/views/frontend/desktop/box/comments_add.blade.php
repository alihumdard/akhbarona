<div id="comment_form_holder">
    <div id="comment_dump_container" class="result"> </div>
    <form method="post" id="comment_form" onsubmit="return updateComments();">
        @csrf
        <input type="hidden" name="action" value="comment" />
        <input type="hidden" name="cmd" value="add" />
        <input type="hidden" name="article_id" value="{{$id}}" />
        <h3>أضف تعليقك</h3>
    <div class="row">
        <div class="col-md-6 mt-3">
            <div>
                <input name="author" maxlength="50" class="form-control placeholder-css me-2" type="text" placeholder="أدخل بريدك الإلكتروني" required>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div>
                <input name="www" maxlength="100" class="form-control placeholder-css me-2" type="text" placeholder="أدخل اسمك" required>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div>
                <div class="form-floating">
                    <textarea minlength="30" maxlength="1000" class="form-control textarea-placeholder" name="description" rows="7" cols="40" onfocus="this.value='';this.onfocus = null;" placeholder="اكتب تعليق" id="floatingTextarea" style="height: 150px" required></textarea>
                </div>
            </div>
            <div class="contact-us-btn text-center mt-4">
                <button type="submit">{{Config::get("site.lang.LNG_ADD_COMMENTS_BUTTON")}}</button>
            </div>
        </div>
    </div>
</form>
</div>


