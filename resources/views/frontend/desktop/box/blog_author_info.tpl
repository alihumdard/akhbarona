<vte:if test="{CURRENT_AUTHOR}">
    <div id="box_users" class="box box_white">
        <h3 class="box_title title_white">
            <vte:if test="{CURRENT_AUTHOR.www}">
                <a href="https://{CURRENT_AUTHOR.www}"><vte:value select="{CURRENT_AUTHOR.get_name}" /></a>
                <vte:else>
                    <vte:value select="{CURRENT_AUTHOR.get_name}" />
                </vte:else>
            </vte:if>
        </h3>
        <vte:if test="{CURRENT_AUTHOR.picture}">
            <img src="{CURRENT_AUTHOR.get_picture_href|summary_small}" alt="{CURRENT_AUTHOR.get_name}" />
        </vte:if>
        <vte:value select="{CURRENT_AUTHOR.get_bio}" />
        <div class="clearer"> </div>
        <vte:box module="box_article_list">
            <vte:params>
                <vte:param name="cache" value="1" />
                <vte:param name="search_sort_by" value="created" />
                <vte:param name="search_user_id" value="{CURRENT_AUTHOR.get_id}" />
                <vte:param name="search_limit" value="10" />
                <vte:param name="search_cid" value="{article.get_category_id}" />
            </vte:params>
            <vte:template>
            	<div class="author_blog_subtitle">
                    <vte:value select="{LNG_AUTHORS_BLOGS}" />
                    <vte:if test="{VIVVO_MODULES_FEED}">
                        <a href="{feed_url}" title="{LNG_USER_FEED}"><img src="{VIVVO_THEME_BANGTD}img/icon_feed.gif" class="subscribe_feed" alt="{LNG_USER_FEED}" /></a>
                    </vte:if>
                </div>
                <ul>
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
    </div>
</vte:if>