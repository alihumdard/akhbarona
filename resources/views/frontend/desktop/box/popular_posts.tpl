<vte:box module="box_article_list">
    <vte:params>
        <vte:param name="cache" value="1" />
        <vte:param name="search_sort_by" value="most_popular" />
        <vte:param name="search_limit" value="5" />
        <vte:param name="search_cid" value="{CURRENT_CATEGORY.get_id}" />
    </vte:params>
    <vte:template>
        <div id="box_category_related" class="box box_white">
            <h3 class="box_title title_white"><vte:value select="{LNG_POPULAR_POSTS}" /></h3>
            <ul>
                <vte:foreach item="article"  key="index" from="{article_list}">
                    <li><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></li>
                </vte:foreach>
            </ul>
        </div>
    </vte:template>
</vte:box>
