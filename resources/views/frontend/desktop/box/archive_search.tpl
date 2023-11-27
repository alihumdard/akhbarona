<div id="archive_search">
    <form id="archive_search_form" method="post" name="archive_search_form" action="{VIVVO_PROXY_URL}search.html?search_archive">
        <div class="form_line"> 
            <label><vte:value select="{LNG_SEARCH_FORM_KEYWORD}" />:</label>
            <div class="formElement">
                <input type="text" class="text default_fields" name="search_query" value="" />
            </div>
        </div>
        <div class="form_line"> 
            <label> </label>
            <div class="formElement">
            <label><input type="checkbox" name="search_title_only" value="1" /><vte:value select="{LNG_SEARCH_FORM_TITLES_ONLY}" /></label>
            </div>
        </div>
        <div class="form_line">
            <label><vte:value select="{LNG_SEARCH_FORM_AUTHOR}" />:</label>
            <div class="formElement">
                <input type="text" class="text default_fields" name="search_author" value="" />
            </div>
        </div>
        <div class="form_line"> 
            <label> </label>
            <div class="formElement">
            <label><input type="checkbox" name="search_author_exact_name" value="1" checked="checked" /><vte:value select="{LNG_SEARCH_FORM_EXACT_NAME}" /></label>
            </div>
        </div>
        <div class="form_line"> 
            <label><vte:value select="{LNG_SEARCH_FORM_CATEGORIES}" />:</label>
            <div class="formElement">
                <select class="options default_fields" id="search_cid" name="search_cid[]" size="13" multiple="multiple">
                    <option value="0" selected="selected"><vte:value select="{LNG_SEARCH_ALL_CATEGORIES}" /></option>
                    <vte:box module="box_sections">
                        <vte:params>
                            <vte:param name="id" value="0" />
                            <vte:param name="prefix" value="" />
                        </vte:params>
                        <vte:template>
                            <vte:foreach item="category" from="{categories}">
                                <vte:if test="!{category.get_redirect}">
                                    <option value="{category.id}">
                                        <vte:attribute name="selected">
                                            <vte:if test="{category.id} in {value}">selected</vte:if>
                                        </vte:attribute>
                                        <vte:attribute name="class">
                                            <vte:if test="!{category.parent_cat}">root</vte:if>
                                        </vte:attribute>
                                        <vte:value select="{prefix}" />- <vte:value select="{category.category_name}" />
                                    </option>
                                </vte:if>
                                <vte:if test="{category.subcategories}">
                                    <vte:load module="box_sections" id="{category.id}" template_string="{template_string}" prefix="&#160;{prefix}" />
                                </vte:if>
                            </vte:foreach>
                        </vte:template>
                    </vte:box>
                </select>
            </div>
        </div>
        <input type="hidden" name="search_tag" value="" />
        <input type="hidden" name="search_options" value="" />
        <div class="form_line"> 
            <label> </label>
            <div class="formElement submit">
                <input type="submit" class="button" name="search_do_advanced" value="{LNG_SEARCH_BUTTON}" />
            </div>
        </div>
    </form>
</div>