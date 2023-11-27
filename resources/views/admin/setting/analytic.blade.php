<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_GA_ENABLED">Enable web analytics:</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_GA_ENABLED") === $key || (old("VIVVO_GA_ENABLED") === null && $key === (int)$settings["VIVVO_GA_ENABLED"]))?' checked="checked"':''}} name="VIVVO_GA_ENABLED" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_GA_EMAIL">Google Analytics email:</label>
            </div>
            <div class="col-md-6 left">
                <input type="email" name="VIVVO_GA_EMAIL" id="VIVVO_GA_EMAIL" class="form-group custom-form-control" value="{{old("VIVVO_GA_EMAIL") !== null?old("VIVVO_GA_EMAIL"):$settings["VIVVO_GA_EMAIL"]}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_GA_PASSWORD">Google Analytics password:</label>
            </div>
            <div class="col-md-6 left">
                <input type="password" name="VIVVO_GA_PASSWORD" id="VIVVO_GA_PASSWORD" class="form-group custom-form-control" value="{{old("VIVVO_GA_PASSWORD") !== null?old("VIVVO_GA_PASSWORD"):$settings["VIVVO_GA_PASSWORD"]}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_GA_CODE">Google tracking code:</label>
            </div>
            <div class="col-md-6 left">
                <spa>UA-</spa><input type="text" name="VIVVO_GA_CODE" id="VIVVO_GA_CODE" class="form-group custom-form-control" value="{{old("VIVVO_GA_CODE") !== null?old("VIVVO_GA_CODE"):$settings["VIVVO_GA_CODE"]}}">
            </div>
        </div>
    </div>
</div>
