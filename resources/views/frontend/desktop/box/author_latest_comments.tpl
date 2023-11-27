<vte:if test="{VIVVO_COMMENTS_ENABLE}">
	<vte:box module="box_comments">
		<vte:params>
			<vte:param name="search_user_id" value="{CURRENT_AUTHOR.get_id}" />
			<vte:param name="search_limit" value="5" />
			<vte:param name="search_sort_by" value="created" />
			<vte:param name="search_order" value="descending" />
			<vte:param name="cache" value="1" />
		</vte:params>
		<vte:template>
			<div id="latest_comments" class="box box_gray">
				<h3 class="box_title title_gray"><vte:value select="{LNG_LATEST_COMMENTS}" /></h3>
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
		</vte:template>
	</vte:box>
</vte:if>