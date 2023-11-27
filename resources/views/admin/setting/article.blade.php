<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_ARTICLE_SHOW_RATING">Show ratings (rate the article):</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_ARTICLE_SHOW_RATING") === $key || (old("VIVVO_ARTICLE_SHOW_RATING") === null && $key === (int)$settings["VIVVO_ARTICLE_SHOW_RATING"]))?' checked="checked"':''}} name="VIVVO_ARTICLE_SHOW_RATING" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_ARTICLE_SHOW_DATE">Show date:</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_ARTICLE_SHOW_DATE") === $key || (old("VIVVO_ARTICLE_SHOW_DATE") === null && $key === (int)$settings["VIVVO_ARTICLE_SHOW_DATE"]))?' checked="checked"':''}} name="VIVVO_ARTICLE_SHOW_DATE" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_ARTICLE_SHOW_AUTHOR">Show author:</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_ARTICLE_SHOW_AUTHOR") === $key || (old("VIVVO_ARTICLE_SHOW_AUTHOR") === null && $key === (int)$settings["VIVVO_ARTICLE_SHOW_AUTHOR"]))?' checked="checked"':''}} name="VIVVO_ARTICLE_SHOW_AUTHOR" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 right">
                <label for="VIVVO_ARTICLE_SHOW_AUTHOR_INFO">Show author info:</label>
            </div>
            <div class="col-md-6 left">
                @foreach([1=>"Yes",0=>"No"] as $key=>$vl)
                    <input type="radio"{{(old("VIVVO_ARTICLE_SHOW_AUTHOR_INFO") === $key || (old("VIVVO_ARTICLE_SHOW_AUTHOR_INFO") === null && $key === (int)$settings["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"]))?' checked="checked"':''}} name="VIVVO_ARTICLE_SHOW_AUTHOR_INFO" value="{{$key}}"> {{$vl}}&nbsp;
                @endforeach
            </div>
        </div>
    </div>
</div>
