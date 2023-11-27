<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_COMMENTS_NUM_PER_PAGE">Number of comments per page:</label>
            </div>
            <div class="col-md-6 left">
                <input type="text" name="VIVVO_COMMENTS_NUM_PER_PAGE" id="VIVVO_COMMENTS_NUM_PER_PAGE" class="form-group custom-form-control" value="{{old("VIVVO_COMMENTS_NUM_PER_PAGE") !== null?old("VIVVO_COMMENTS_NUM_PER_PAGE"):$settings["VIVVO_COMMENTS_NUM_PER_PAGE"]}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_COMMENTS_ORDER">Order comments:</label>
            </div>
            <div class="col-md-6 left">
                @foreach(["ascending"=>"older first","descending"=>"newer first"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_COMMENTS_ORDER") === $key || (old("VIVVO_COMMENTS_ORDER") === null && $key === $settings["VIVVO_COMMENTS_ORDER"]))?' checked="checked"':''}} name="VIVVO_COMMENTS_ORDER" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_COMMENTS_ENABLE_BBCODE">Enable BBCode tags:</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_COMMENTS_ENABLE_BBCODE") === $key || (old("VIVVO_COMMENTS_ENABLE_BBCODE") === null && $key === (int)$settings["VIVVO_COMMENTS_ENABLE_BBCODE"]))?' checked="checked"':''}} name="VIVVO_COMMENTS_ENABLE_BBCODE" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_COMMENTS_ENABLE_THREADED">Enable threaded comments:</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_COMMENTS_ENABLE_THREADED") === $key || (old("VIVVO_COMMENTS_ENABLE_THREADED") === null && $key === (int)$settings["VIVVO_COMMENTS_ENABLE_THREADED"]))?' checked="checked"':''}} name="VIVVO_COMMENTS_ENABLE_THREADED" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_COMMENTS_REPORT_INAPPROPRIATE">Report inappropriate comments:</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_COMMENTS_REPORT_INAPPROPRIATE") === $key || (old("VIVVO_COMMENTS_REPORT_INAPPROPRIATE") === null && $key === (int)$settings["VIVVO_COMMENTS_REPORT_INAPPROPRIATE"]))?' checked="checked"':''}} name="VIVVO_COMMENTS_REPORT_INAPPROPRIATE" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_COMMENTS_FLOOD_PROTECTION">Flood protection:</label>
            </div>
            <div class="col-md-6 left">
                <input type="text" name="VIVVO_COMMENTS_FLOOD_PROTECTION" id="VIVVO_COMMENTS_FLOOD_PROTECTION" class="form-group custom-form-control" value="{{old("VIVVO_COMMENTS_FLOOD_PROTECTION") !== null?old("VIVVO_COMMENTS_FLOOD_PROTECTION"):$settings["VIVVO_COMMENTS_FLOOD_PROTECTION"]}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_COMMENTS_CAPTHA">CAPTCHA (image code) for comments:</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_COMMENTS_CAPTHA") === $key || (old("VIVVO_COMMENTS_CAPTHA") === null && $key === (int)$settings["VIVVO_COMMENTS_CAPTHA"]))?' checked="checked"':''}} name="VIVVO_COMMENTS_CAPTHA" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_COMMENTS_BAD_WORDS">Bad words (comma separated):</label>
            </div>
            <div class="col-md-6 left">
                <textarea rows="4" name="VIVVO_COMMENTS_BAD_WORDS" id="VIVVO_COMMENTS_BAD_WORDS" class="form-group custom-form-control">{{old("VIVVO_COMMENTS_BAD_WORDS") !== null?old("VIVVO_COMMENTS_BAD_WORDS"):$settings["VIVVO_COMMENTS_BAD_WORDS"]}}</textarea>
            </div>

        </div>
    </div>
</div>
