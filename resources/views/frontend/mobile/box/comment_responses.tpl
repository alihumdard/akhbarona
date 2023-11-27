<vte:foreach item="comment" from="{comment_list}" key="comment_num">
	<div class="comment_holder">
		<a name="comment_{comment.get_id}"> </a>
        <div class="comment_body">
            <div class="comment_header">
				<vte:value select="{comment_num}" /> |
				<vte:value select="{comment.get_author}" />
            </div>
			<div class="comment_title">
				<vte:value select="{comment.get_www}" />
			</div>
            <div class="comment_text">
                <vte:value select="{comment.get_description}" />
            </div>
            <div class="comment_actions">
                <vte:if test="{VIVVO_COMMENTS_ENABLE_THREADED}">
                    <a class="comment_reply" href="{CURRENT_URL}#post-reply" onclick="return reply_to_comment({comment.get_id},{comment.get_root_comment},{comment.get_plain_summary|json_encode_attr});"><vte:value select="{LNG_COMMENT_REPLY}" /></a>
                </vte:if>
                <a href="javascript:voteComment({comment.get_id}, 1);"><img src="{VIVVO_THEME_BANGTD}img/thumbs_up.gif" title="{LNG_COMMENTS_THUMB_UP}" alt="{LNG_COMMENTS_THUMB_UP}" /></a>
                <a href="javascript:voteComment({comment.get_id}, -1);"><img src="{VIVVO_THEME_BANGTD}img/thumbs_down.gif" title="{LNG_COMMENTS_THUMB_DOWN}" alt="{LNG_COMMENTS_THUMB_DOWN}" /></a>
                <div id="comment_vote_{comment.get_id}" class="result">
                    <vte:value select="{comment.get_vote}" />
                </div>
                <vte:if test="{VIVVO_EMAIL_ENABLE}">
                    <vte:if test="{VIVVO_COMMENTS_REPORT_INAPPROPRIATE}">
                        <span id="comment_report_{comment.get_id}">
                            <a href="javascript:reportComment({comment.get_id});">
                                <img src="{VIVVO_THEME_BANGTD}img/comment_report.gif" title="{LNG_COMMENTS_REPORT_INAPPROPRIATE}" alt="{LNG_COMMENTS_REPORT_INAPPROPRIATE}" />
                            </a>
                        </span>
                    </vte:if>
                </vte:if>
				<span class="comment_stamp">
					<vte:value select="{comment.create_dt|format_date:'Y/m/d - h:i'}" />
				</span>
            </div>
        </div>
        <vte:if test="{VIVVO_COMMENTS_ENABLE_THREADED}">
            <vte:value select="{comment.render_responses|'box/comment_responses.tpl'}" />
			<div id="new_comment_holder_{comment.get_id}">  </div>
        </vte:if>
	</div>
</vte:foreach>