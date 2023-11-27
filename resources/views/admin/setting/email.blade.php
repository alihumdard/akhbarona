<div class="row">
    <div class="col-md-12">
        <div class="container" style="margin-bottom: 20px;">
            <ul class="nav nav-tabs setting-email-nav-tabs">
                <li class="active"><a href="javascript:;" data-id="tab_email_options">Email Options</a></li>
                <li><a href="javascript:;" data-id="tab_email_to_friend">Email to a friend template</a></li>
            </ul>
        </div>
        <div id="tab_email_options">
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_EMAIL_SEND_FROM">Send mail from:</label>
                </div>
                <div class="col-md-6 left">
                    <input type="text" name="VIVVO_EMAIL_SEND_FROM" id="VIVVO_EMAIL_SEND_FROM" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_SEND_FROM") !== null?old("VIVVO_EMAIL_SEND_FROM"):$settings["VIVVO_EMAIL_SEND_FROM"]}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_EMAIL_SEND_CC">Send mail CC:</label>
                </div>
                <div class="col-md-6 left">
                    <input type="text" name="VIVVO_EMAIL_SEND_CC" id="VIVVO_EMAIL_SEND_CC" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_SEND_CC") !== null?old("VIVVO_EMAIL_SEND_CC"):$settings["VIVVO_EMAIL_SEND_CC"]}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_EMAIL_SEND_BCC">Send mail BCC:</label>
                </div>
                <div class="col-md-6 left">
                    <input type="text" name="VIVVO_EMAIL_SEND_BCC" id="VIVVO_EMAIL_SEND_BCC" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_SEND_BCC") !== null?old("VIVVO_EMAIL_SEND_BCC"):$settings["VIVVO_EMAIL_SEND_BCC"]}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_EMAIL_FLOOD_CHECK">Email flood check (in seconds):</label>
                </div>
                <div class="col-md-6 left">
                    <input type="text" name="VIVVO_EMAIL_FLOOD_CHECK" id="VIVVO_EMAIL_FLOOD_CHECK" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_FLOOD_CHECK") !== null?old("VIVVO_EMAIL_FLOOD_CHECK"):$settings["VIVVO_EMAIL_FLOOD_CHECK"]}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_COMMENTS_ENABLE_THREADED">Use PHP mail() function or SMTP:</label>
                </div>
                <div class="col-md-6 left">
                    @foreach([1=>"PHP mail()",0=>"SMTP"] as $key=>$vl)
                        <input type="radio"{{(old("VIVVO_EMAIL_SMTP_PHP") === $key || (old("VIVVO_EMAIL_SMTP_PHP") === null && $key === (int)$settings["VIVVO_EMAIL_SMTP_PHP"]))?' checked="checked"':''}} name="VIVVO_EMAIL_SMTP_PHP" value="{{$key}}"> {{$vl}}&nbsp;
                    @endforeach
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_EMAIL_SMTP_HOST">SMTP host:</label>
                </div>
                <div class="col-md-6 left">
                    <input type="text" name="VIVVO_EMAIL_SMTP_HOST" id="VIVVO_EMAIL_SMTP_HOST" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_SMTP_HOST") !== null?old("VIVVO_EMAIL_SMTP_HOST"):$settings["VIVVO_EMAIL_SMTP_HOST"]}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_EMAIL_SMTP_PORT">SMTP port:</label>
                </div>
                <div class="col-md-6 left">
                    <input type="text" name="VIVVO_EMAIL_SMTP_PORT" id="VIVVO_EMAIL_SMTP_PORT" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_SMTP_PORT") !== null?old("VIVVO_EMAIL_SMTP_PORT"):$settings["VIVVO_EMAIL_SMTP_PORT"]}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_EMAIL_SMTP_USERNAME">SMTP username:</label>
                </div>
                <div class="col-md-6 left">
                    <input type="text" name="VIVVO_EMAIL_SMTP_USERNAME" id="VIVVO_EMAIL_SMTP_USERNAME" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_SMTP_USERNAME") !== null?old("VIVVO_EMAIL_SMTP_USERNAME"):$settings["VIVVO_EMAIL_SMTP_USERNAME"]}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 right">
                    <label for="VIVVO_EMAIL_SMTP_PASSWORD">SMTP password:</label>
                </div>
                <div class="col-md-6 left">
                    <input type="password" name="VIVVO_EMAIL_SMTP_PASSWORD" id="VIVVO_EMAIL_SMTP_PASSWORD" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_SMTP_PASSWORD") !== null?old("VIVVO_EMAIL_SMTP_PASSWORD"):$settings["VIVVO_EMAIL_SMTP_PASSWORD"]}}">
                </div>
            </div>
        </div>
        <div id="tab_email_to_friend" style="display: none;padding-left: 30px;">
            <div class="form-group row">
                <div class="col-md-6 left" style="padding-left: 30px;">
                    <label for="VIVVO_EMAIL_TO_A_FRIEND_SUBJECT">Subject:</label>
                    <input type="text" name="VIVVO_EMAIL_TO_A_FRIEND_SUBJECT" id="VIVVO_EMAIL_TO_A_FRIEND_SUBJECT" class="form-group custom-form-control" value="{{old("VIVVO_EMAIL_TO_A_FRIEND_SUBJECT") !== null?old("VIVVO_EMAIL_TO_A_FRIEND_SUBJECT"):$settings["VIVVO_EMAIL_TO_A_FRIEND_SUBJECT"]}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <textarea class="custom-form-control" rows="20" name="VIVVO_EMAIL_TO_A_FRIEND_BODY" style="width: 98%">{!!old("VIVVO_EMAIL_TO_A_FRIEND_BODY") !== null?old("VIVVO_EMAIL_TO_A_FRIEND_BODY"):$settings["VIVVO_EMAIL_TO_A_FRIEND_BODY"]!!}</textarea>
                </div>
            </div>

        </div>
    </div>
</div>
