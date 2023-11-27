<?php $setting = App\Models\Config::getAllValue();?>
@if(isset($setting["VIVVO_MODULES_SEARCH"]) && $setting["VIVVO_MODULES_SEARCH"])
    <div id="box_search" class="search">
        <form action="" method="post" name="search" id="top_search" onsubmit="return searchKeyword('top_search');">
            <input value="" required="required" class="text search_input default_fields" type="text" name="search_query" id="search_query" />
            <button type="submit" name="search" value="0">{{Config::get("site.lang.LNG_SEARCH_BUTTON")}}</button>
        </form>
    </div>
@endif
