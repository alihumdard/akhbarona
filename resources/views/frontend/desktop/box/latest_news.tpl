<vte:box module="box_article_list">
    <vte:params>
        <vte:param name="search_sort_by" value="{VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER}" />
        <vte:param name="search_order" value="descending" />
        <vte:param name="search_cid" value="{VIVVO_HOMEPAGE_ARTICLE_LIST_CATEGORIES}" />
        <vte:param name="search_limit" value="{VIVVO_HOMEPAGE_ARTICLE_LIST_NUMBER}" />
        <vte:param name="add_to_printed" value="true" />
        <vte:param name="exclude_printed" value="true" />
    </vte:params>
    <vte:template>
        <div id="latest_news" class="box box_gray">
            <h3 class="box_title title_gray"><vte:value select="{LNG_LATEST_NEWS}" /></h3>
            <vte:foreach item = "article" from = "{article_list}" start="1" loop="1">
                <vte:if test="{article.image}">
                    <a href="{article.get_href}">
                        <vte:if test="{article.get_image_caption}">
                            <vte:variable name="image_caption" value="{article.get_image_caption}" />
                            <vte:else>
                                <vte:variable name="image_caption" value="{article.get_title}" />
                            </vte:else>
                        </vte:if>
                        <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_small}" alt="{image_caption}" /><br />
                    </a>
                </vte:if>
                <h4><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h4>
                <p>
                    <vte:value select="{article.get_summary}" /><vte:if test="{article.body}">...</vte:if>
                    <vte:if test="!{article.get_link}">
                        <vte:if test="{article.body}">
                            <a href="{article.get_href}"> <vte:value select="{LNG_FULL_STORY}" /></a>
                        </vte:if>
                        <vte:else>
                            <a class="visit" href="{article.get_link}"><img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}" /></a>
                        </vte:else>
                    </vte:if>
                </p>
            </vte:foreach>
            <ul>
                <vte:foreach item = "article" from = "{article_list}" start="2">
                    <li>
                        <a href="{article.get_href}">
                            <vte:value select="{article.get_title}" />
                        </a>
                    </li>
                </vte:foreach>
            </ul>
        </div>
    </vte:template>
</vte:box>