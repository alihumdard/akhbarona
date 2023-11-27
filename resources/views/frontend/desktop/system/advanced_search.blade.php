<div id="articles_search">
    <form id="article_search_form" name="article_search_form" method="post" onsubmit="return searchKeyword('article_search_form');">
        <div class="form_line">
            <label>{{Config::get("site.lang.LNG_SEARCH_FORM_KEYWORD")}}:</label>
            <div class="formElement">
                <input type="text" class="text default_fields" name="search_query" value="{{isset($_GET["search_query"])?$_GET["search_query"]:""}}" />
            </div>
        </div>

        <div class="form_line">
            <label> </label>
            <div class="formElement">
            <label><input type="checkbox" name="search_title_only" value="1" @if(isset($_GET["search_title_only"]) && $_GET["search_title_only"]) checked="checked" @endif />{{Config::get("site.lang.LNG_SEARCH_FORM_TITLES_ONLY")}}</label>
            </div>
        </div>

        <div class="form_line">
            <label>{{Config::get("site.lang.LNG_SEARCH_FORM_AUTHOR")}}:</label>
            <div class="formElement">
                <input type="text" class="text default_fields" name="search_author" value="{{isset($_GET["search_author"])?$_GET["search_author"]:""}}" />
            </div>
        </div>

        <div class="form_line">
            <label> </label>
            <div class="formElement">
            <label><input type="checkbox" name="search_author_exact_name" value="1" @if(!isset($_GET["search_author_exact_name"]) || (isset($_GET["search_author_exact_name"]) && $_GET["search_author_exact_name"])) checked="checked" @endif />{{Config::get("site.lang.LNG_SEARCH_FORM_EXACT_NAME")}}</label>
            </div>
        </div>

        <div class="form_line">
            <label>{{Config::get("site.lang.LNG_SEARCH_FORM_POST")}}:</label>
            <div class="formElement">
                <select class="default_fields" name="search_search_date">
                    <option value="0">{{Config::get("site.lang.LNG_SEARCH_OPTION_ANY_DATE")}}</option>
                    <option value="1" @if(isset($_GET["search_search_date"]) && $_GET["search_search_date"] == 1) selected="selected" @endif >{{Config::get("site.lang.LNG_SEARCH_OPTION_YESTRDAY")}}</option>
                    <option value="7" @if(isset($_GET["search_search_date"]) && $_GET["search_search_date"] == 7) selected="selected" @endif>{{Config::get("site.lang.LNG_SEARCH_OPTION_A_WEEK_AGO")}}</option>
                    <option value="14" @if(isset($_GET["search_search_date"]) && $_GET["search_search_date"] == 14) selected="selected" @endif>{{Config::get("site.lang.LNG_SEARCH_OPTION_2_WEEKS_AGO")}}</option>
                    <option value="30" @if(isset($_GET["search_search_date"]) && $_GET["search_search_date"] == 30) selected="selected" @endif>{{Config::get("site.lang.LNG_SEARCH_OPTION_A_MONTH_AGO")}}</option>
                    <option value="90" @if(isset($_GET["search_search_date"]) && $_GET["search_search_date"] == 90) selected="selected" @endif>{{Config::get("site.lang.LNG_SEARCH_OPTION_3_MONTHS_AGO")}}</option>
                    <option value="180" @if(isset($_GET["search_search_date"]) && $_GET["search_search_date"] == 180) selected="selected" @endif>{{Config::get("site.lang.LNG_SEARCH_OPTION_6_MONTHS_AGO")}}</option>
                    <option value="365" @if(isset($_GET["search_search_date"]) && $_GET["search_search_date"] == 365) selected="selected" @endif>{{Config::get("site.lang.LNG_SEARCH_OPTION_A_YEAR_AGO")}}</option>
                </select>
            </div>
        </div>

        <div class="form_line">
            <label> </label>
            <div class="formElement">
            <label><input type="checkbox" name="search_before_after" value="1" @if(!isset($_GET["search_before_after"]) || (isset($_GET["search_before_after"]) && $_GET["search_before_after"])) checked="checked" @endif />{{Config::get("site.lang.LNG_SEARCH_FORM_AND_OLDER")}}</label>
            </div>
        </div>

        <div class="form_line">
            <label>{{Config::get("site.lang.LNG_SEARCH_FORM_CATEGORIES")}}:</label>
            <div class="formElement">
                <select class="default_fields" id="search_cid" name="search_cid[]" size="13" multiple="multiple">
                    <option value="0">{{Config::get("site.lang.LNG_SEARCH_ALL_CATEGORIES")}}</option>
                    @foreach($categories as $cat)
                        @if(!$cat->redirect)
                            <option value="{{$cat->id}}" @if(!$cat->parent_cat) class="root" @endif @if(isset($_GET["search_cid"]) && in_array($cat->id,$_GET["search_cid"])) selected="selected" @endif>
                                - {{$cat->category_name}}
                            </option>
                        @endif
                    @endforeach

                </select>
            </div>
        </div>

        <input type="hidden" name="search_tag" value="" />
        <input type="hidden" name="search_options" value="" />
        <div class="form_line">
            <label> </label>
            <div class="formElement">
                <input type="submit" class="button" name="search_do_advanced" value="{{Config::get("site.lang.LNG_SEARCH_BUTTON")}}" />
            </div>
        </div>
    </form>
</div>
