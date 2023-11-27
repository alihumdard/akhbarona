<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_WEBSITE_TITLE">Cache type:</label>
            </div>
            <div class="col-md-6 left">
                <select class="form-group custom-form-control" name="VIVVO_CACHE_ENABLE" id="VIVVO_CACHE_ENABLE">
                    @foreach([0=>"No Cache",3=>"Memcache",2=>"File"] as $key=>$vl)
                        <option value="{{$key}}"{{(old("VIVVO_CACHE_ENABLE") === $key)?" selected":((old("VIVVO_CACHE_ENABLE") === null && $settings["VIVVO_CACHE_ENABLE"] == $key)?" selected":"")}}>{{$vl}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_CACHE_TIME">Cache time period:</label>
            </div>
            <div class="col-md-6 left">
                <input type="text" name="VIVVO_CACHE_TIME" id="VIVVO_CACHE_TIME" class="form-group custom-form-control" value="{{old("VIVVO_CACHE_TIME") !== null?old("VIVVO_CACHE_TIME"):$settings["VIVVO_CACHE_TIME"]}}"> <span>Seconds</span>
            </div>
        </div>
    </div>
</div>
