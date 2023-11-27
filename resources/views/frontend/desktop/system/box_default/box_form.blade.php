<div id="box_center_holder">
    <div class="box_white_pages">
        <div class="box box_form">
            <div class="box_title_holder"><div class="box_title">إتصل بنا</div></div>
            <div class="box_body">
                <div class="box_content">
                    @if(Session::get('success', false))
                        {{ Session::get('success') }}
                    @else
                        <form method="post" class="form_builder">
                        <input type="hidden" name="form_id" value="1">
                        <input type="hidden" name="action" value="form_builder">
                        <input type="hidden" name="cmd" value="mail">
                            @if(isset ($errors) && count($errors) > 0)
                                <div class="error_message">
                                    @foreach($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            @endif

                        <div class="form_line" title="">
                            <p>يمكنكم الاتصال بنا على الرقم التالي : الهاتف: 00212690937254</p>
                        </div>
                        <div class="form_line" title="">
                            <strong>Akhbarona media</strong>
                        </div>
                        <div class="form_line" title="">
                            <p>Maroc</p>
                        </div>
                        <div class="form_line" title="">
                            <p>--------------</p>
                        </div>
                        <div class="form_line" title="">
                            <p>أو مراسلتنا عبر الايميل :</p>
                        </div>
                        <div class="form_line" title="">
                            <p>Contact@akhbarona.com</p>
                        </div>
                        <div class="form_line" title="">
                            <p>أو يمكنك إرسالهما مباشرة عبر</p>
                        </div>
                        <div class="form_line" title="">
                            <label class="required">
                                الاسم الأول
                            </label>
                            <div class="formElement" title="">
                                <input class="form_builder_text" type="text" name="field_1" value="" required="required">
                            </div>
                        </div>
                        <div class="form_line" title="">
                            <label>
                                اللقب
                            </label>
                            <div class="formElement" title="">
                                <input class="form_builder_text" type="text" name="field_2" value="">
                            </div>
                        </div>
                        <div class="form_line" title="">
                            <label class="required">
                                البريد الإلكتروني
                            </label>
                            <div class="formElement" title="">
                                <input class="form_builder_text" type="text" name="field_4" value="" required="required">
                            </div>
                        </div>
                        <div class="form_line" title="">
                            <label>
                                سبب الإتصال
                            </label>
                            <div class="formElement" title="">
                                <select class="form_builder_options" name="field_6" size="">
                                    <option value="استفسار" selected="selected">
                                        استفسار
                                    </option>
                                    <option value="إعلان">
                                        إعلان
                                    </option>
                                    <option value="شكوى">
                                        شكوى
                                    </option>
                                    <option value="سبب آخر">
                                        سبب آخر
                                    </option>
                                </select>
                                <img class="info_help" src="{{$cdnUrl}}themes/akhbarona210/img/icon_pref_help.gif" title="اختيار السبب">
                            </div>
                        </div>
                        <div class="form_line" title="">
                            <label class="required">
                                عنوان الرسالة
                            </label>
                            <div class="formElement" title="">
                                <input class="form_builder_text" type="text" name="field_6" value="" required="required">
                            </div>
                        </div>
                        <div class="form_line" title="">
                            <label class="required">
                                الرسالة
                            </label>
                            <div class="formElement" title="">
                                <textarea class="form_builder_textarea" cols="0" rows="3" name="field_5" required="required"></textarea>
                                <img class="info_help" src="{{$cdnUrl}}themes/akhbarona210/img/icon_pref_help.gif" title="أكتب نص الرسالة هنا">
                            </div>
                        </div>
                        <div class="form_line" title="">
                            <label> </label>
                            <div class="formElement" title="">
                                <input type="submit" name="submit_form" value="ارسال">
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
