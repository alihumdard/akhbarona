<vte:template>
	<vte:if test="{VIVVO_COMMENTS_ENABLE}">
		<div class="box box_white">
            <ul id="most_commented_tabs" class="tabs">
                <vte:if test="{VIVVO_MODULES_MOST_COMMENTED}">
                    <li><a href="#box_most_commented"><vte:value select="{LNG_MOST_COMMENTED}" /></a></li>
                </vte:if>
                <vte:if test="{VIVVO_MODULES_LAST_COMMENTED}">
                    <li><a href="#latest_comments"><vte:value select="{LNG_LATEST_COMMENTS}" /></a></li>
                </vte:if>
            </ul>
            <vte:if test="{VIVVO_MODULES_MOST_COMMENTED}">
                <vte:box module="box_article_list">
                    <vte:params>
                        <vte:param name="cache" value="1" />
                        <vte:param name="search_sort_by" value="most_commented" />
                        <vte:param name="search_limit" value="5" />
                        <vte:param name="fields" value="title,SEfriendly,category_id" />
                    </vte:params>
                    <vte:template>
                        <ul id="box_most_commented">
                            <vte:foreach item="article"  key="index" from="{article_list}">
                                <li><a href="{VIVVO_URL}{article.get_href}"><vte:value select="{article.get_title}" /></a></li>
                            </vte:foreach>
                        </ul>
                    </vte:template>
                </vte:box>
            </vte:if>
            <vte:if test="{VIVVO_MODULES_LAST_COMMENTED}">
                <vte:box module="box_comments">
                    <vte:params>
                        <vte:param name="search_limit" value="5" />
                        <vte:param name="search_sort_by" value="created" />
                        <vte:param name="search_order" value="descending" />
                        <vte:param name="cache" value="1" />
                    </vte:params>
                    <vte:template>
                        <div class="comments">
                            <div id="latest_comments">
                                <vte:if test="{comment_list}">
                                    <vte:foreach item = "comment" from = "{comment_list}">
                                        <div class="single_comment">
                                            <div class="comment_header">
                                                <img src="{comment.get_avatar|24}" alt="avatar" width="24" height="24" />
                                                <vte:if test="{comment.get_www}">
                                                    <a href="https://{comment.get_www}" target="_blank"><vte:value select="{comment.get_author}" /></a>
                                                    <vte:else>
                                                        <strong><vte:value select="{comment.get_author}" /></strong>
                                                    </vte:else>
                                                </vte:if>
                                                <vte:value select="{LNG_ARTICLE_COMMENTS_POSTED_ON}" /> 
                                                <vte:value select="{comment.get_create_dt}" />
                                            </div>
                                            <div class="comment_body">
                                                <a href="{comment.get_article_href}"><vte:value select="{comment.get_summary|strip_tags}" /></a>
                                            </div>
                                        </div>
                                    </vte:foreach>
                                </vte:if>
                            </div>
                        </div>
                    </vte:template>
                </vte:box>
            </vte:if>
            <script type="text/javascript">
                var most_popular_commented_tabs = new Control.Tabs('most_commented_tabs');
            </script>
		</div>
    </vte:if>
</vte:template>