<vte:box module="box_sections">
    <vte:params>
        <vte:param name="cache" value="1" />
        <vte:param name="search_ids" value="{VIVVO_MODULES_MORE_NEWS_CATEGORIES}" />
    </vte:params>
    <vte:template>
        <div class="main_news_box_holder">
            <vte:for from="{categories}" step="2" key="category_index">
                <div class="main_news_box_row">
                    <vte:foreach item = "category" from = "{categories}" loop="2" start="{category_index}" key="col">
                        <div id="box_more_category_list_{category.get_id}" class="main_news_category cell_{col|mod:'2'}">
                            <h3 class="box_title title_gray">
                                <a href="{category.get_href}"><vte:value select="{category.get_category_name}" /></a>
                            </h3>
                            <vte:if test="{category.subcategories}">
                                <div class="title_subcategory">
                                    <vte:foreach item = "sub_category" from = "{category.subcategories}" key="index">
                                        <a href="{sub_category.get_href}"><vte:value select="{sub_category.get_category_name}" /></a>
                                    </vte:foreach>
                                </div>
                            </vte:if>
                            <vte:box module="box_article_list">
                                <vte:params>
                                    <vte:param name="search_sort_by" value="created" />
                                    <vte:param name="search_limit" value="{VIVVO_MODULES_MORE_NEWS_ARTICLE_NUMBER}" />
                                    <vte:param name="search_cid" value="{category.id}" />
                                    <vte:param name="add_to_printed" value="true" />
                                    <vte:param name="exclude_printed" value="true" />
                                </vte:params>
                                <vte:template>
                                    <ul>
                                        <vte:foreach item = "article" from = "{article_list}">
                                            <li><a href="{article.get_href}"><vte:value select="{article.title}" /><vte:if test="{article.get_link}"> <img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}"/></vte:if></a></li>
                                        </vte:foreach>
                                    </ul>
                                </vte:template>
                            </vte:box>
                        </div>
                    </vte:foreach>
                </div>
            </vte:for>
        </div>
    </vte:template>
</vte:box>