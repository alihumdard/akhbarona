<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_WEBSITE_TITLE">Website title:</label>
            </div>
            <div class="col-md-6 left">
                <input type="text" name="VIVVO_WEBSITE_TITLE" id="VIVVO_WEBSITE_TITLE" class="form-group custom-form-control" value="{{old("VIVVO_WEBSITE_TITLE") !== null?old("VIVVO_WEBSITE_TITLE"):$settings["VIVVO_WEBSITE_TITLE"]}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_ADMINISTRATORS_EMAIL">Administrator's e-mail:</label>
            </div>
            <div class="col-md-6 left">
                <input type="email" name="VIVVO_ADMINISTRATORS_EMAIL" id="VIVVO_ADMINISTRATORS_EMAIL" class="form-group custom-form-control" value="{{old("VIVVO_ADMINISTRATORS_EMAIL") !== null?old("VIVVO_ADMINISTRATORS_EMAIL"):$settings["VIVVO_ADMINISTRATORS_EMAIL"]}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_GENERAL_META_KEYWORDS">META keywords:</label>
            </div>
            <div class="col-md-6 left">
                <textarea rows="4" name="VIVVO_GENERAL_META_KEYWORDS" id="VIVVO_GENERAL_META_KEYWORDS" class="form-group custom-form-control">{{old("VIVVO_GENERAL_META_KEYWORDS") !== null?old("VIVVO_GENERAL_META_KEYWORDS"):$settings["VIVVO_GENERAL_META_KEYWORDS"]}}</textarea>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_GENERAL_META_DESCRIPTION">META description:</label>
            </div>
            <div class="col-md-6 left">
                <textarea rows="4" name="VIVVO_GENERAL_META_DESCRIPTION" id="VIVVO_GENERAL_META_DESCRIPTION" class="form-group custom-form-control">{{old("VIVVO_GENERAL_META_DESCRIPTION") !== null?old("VIVVO_GENERAL_META_DESCRIPTION"):$settings["VIVVO_GENERAL_META_DESCRIPTION"]}}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_GENERAL_WEBSITE_LOGO_image">RSS Feed logo:</label>
            </div>
            <div class="col-md-6 left">
                <input type="text" name="VIVVO_GENERAL_WEBSITE_LOGO" id="VIVVO_GENERAL_WEBSITE_LOGO_image" class="form-group custom-form-control" value="{{old("VIVVO_GENERAL_WEBSITE_LOGO") !== null?old("VIVVO_GENERAL_WEBSITE_LOGO"):$settings["VIVVO_GENERAL_WEBSITE_LOGO"]}}">
                &nbsp;<a href="javascript:;" id="setting_logo_select_image"><i class="fas fa-search"></i></a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_ALLOWED_EXTENSIONS">Allowed file types for upload (comma separated):</label>
            </div>
            <div class="col-md-6 left">
                <input type="text" name="VIVVO_ALLOWED_EXTENSIONS" id="VIVVO_ALLOWED_EXTENSIONS" class="form-group custom-form-control" value="{{old("VIVVO_ALLOWED_EXTENSIONS") !== null?old("VIVVO_ALLOWED_EXTENSIONS"):$settings["VIVVO_ALLOWED_EXTENSIONS"]}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_DATE_FORMAT">Date / Time format:</label>
            </div>
            <div class="col-md-6 left">
                <input type="text" name="VIVVO_DATE_FORMAT" id="VIVVO_DATE_FORMAT" class="form-group custom-form-control" value="{{old("VIVVO_DATE_FORMAT") !== null?old("VIVVO_DATE_FORMAT"):$settings["VIVVO_DATE_FORMAT"]}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_GENERAL_TIME_ZONE_FORMAT">Time zone:</label>
            </div>
            <div class="col-md-6 left">
                <input type="text" name="VIVVO_GENERAL_TIME_ZONE_FORMAT" id="VIVVO_GENERAL_TIME_ZONE_FORMAT" class="form-group custom-form-control" value="{{old("VIVVO_GENERAL_TIME_ZONE_FORMAT") !== null?old("VIVVO_GENERAL_TIME_ZONE_FORMAT"):$settings["VIVVO_GENERAL_TIME_ZONE_FORMAT"]}}">
            </div>
        </div>
    </div>
</div>
