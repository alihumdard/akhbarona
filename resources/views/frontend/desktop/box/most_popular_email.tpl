<vte:template>
	<div class="box box_white">
        <ul id="most_popular_commented_tabs" class="tabs">
            <vte:if test="{VIVVO_MODULES_MOST_POPULAR}">
                <li><a href="#box_most_popular"><vte:value select="{LNG_MOST_POPULAR}" /></a></li>
            </vte:if>
            <vte:if test="{VIVVO_MODULES_MOST_EMAILED}">
                <li><a href="#box_most_emailed"><vte:value select="{LNG_MOST_EMAILED}" /></a></li>
            </vte:if>
        </ul>
        <vte:if test="{VIVVO_MODULES_MOST_POPULAR}">
            <vte:box module="box_article_list">
                <vte:params>
                    <vte:param name="cache" value="1" />
                    <vte:param name="search_sort_by" value="most_popular" />
                    <vte:param name="search_limit" value="5" />
                    <vte:param name="fields" value="title,SEfriendly,category_id" />
                </vte:params>
                <vte:template>
                    <ul id="box_most_popular">
                        <vte:foreach item = "article" from = "{article_list}">
                            <li>
                                <a href="{article.get_href}">
                                    <vte:value select="{article.get_title}" />
                                </a>
                            </li>
                        </vte:foreach>
                    </ul>
                </vte:template>
            </vte:box>
        </vte:if>
        <vte:if test="{VIVVO_MODULES_MOST_EMAILED}">
            <vte:box module="box_article_list">
                <vte:params>
                    <vte:param name="cache" value="1" />
                    <vte:param name="search_sort_by" value="most_emailed" />
                    <vte:param name="search_limit" value="5" />
                    <vte:param name="fields" value="title,SEfriendly,category_id" />
                </vte:params>
                <vte:template>
                    <ul id="box_most_emailed">
                        <vte:foreach item = "article" from = "{article_list}">
                            <li>
                                <a href="{article.get_href}">
                                    <vte:value select="{article.get_title}" />
                                </a>
                            </li>
                        </vte:foreach>
                    </ul>
                </vte:template>
            </vte:box>
        </vte:if>
        <script type="text/javascript">
            var most_popular_commented_tabs = new Control.Tabs('most_popular_commented_tabs');
        </script>
	</div>
</vte:template>