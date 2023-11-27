<vte:if test="{VIVVO_COMMENTS_ENABLE}">
	<vte:if test="{ajax_output}">
		<vte:if test="{action}">
			<vte:if test="!{CURRENT_USER}">
				<vte:box module="box_comments">
					<vte:params>
						<vte:param name="search_article_id" value="{COMMENT_article_id}" />
						<vte:param name="search_limit" value="1" />
						<vte:param name="search_sort_by" value="created" />
						<vte:param name="search_order" value="descending" />
					</vte:params>
					<vte:template>
						<vte:if test="{guest_group_wait_comment_for_approval} = '2'">
							<div id="comment_dump">
								<vte:value select="{LNG_ADD_COMMENTS_WAITING}" />
							</div>
							<vte:else>
								<vte:foreach item="comment" from="{comment_list}" key="comment_num">
									<div class="comment_holder">
                                        <div class="comment_body">
                                            <div class="comment_header">
												<vte:value select="{comment_num}" /> |
												<vte:value select="{comment.get_author}" />
                                            </div>
											<div class="comment_title">
												<vte:value select="{comment.get_www}" />
											</div>
                                            <div class="comment_text"><vte:value select="{comment.get_description}" /></div>
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
													<vte:value select="{comment.create_dt|pretty_date}" />
												</span>
                                            </div>
                                        </div>
										<vte:if test="{VIVVO_COMMENTS_ENABLE_THREADED}">
											<div id="new_comment_holder_{comment.get_id}">  </div>
										</vte:if>
                                    </div>
								</vte:foreach>
							</vte:else>
						</vte:if>
					</vte:template>
				</vte:box>
				<vte:else>
					<vte:if test="{CURRENT_USER.privileges[ARTICLE_COMMENT]} = '2'">
						<div id="comment_dump">
							<vte:value select="{LNG_ADD_COMMENTS_WAITING}" />
						</div>
						<vte:else>
							<vte:box module="box_comments">
								<vte:params>
									<vte:param name="search_article_id" value="{COMMENT_article_id}" />
									<vte:param name="search_limit" value="1" />
									<vte:param name="search_sort_by" value="created" />
									<vte:param name="search_order" value="descending" />
								</vte:params>
								<vte:template>
									<vte:foreach item="comment" from="{comment_list}" key="comment_num">
										<div class="comment_holder">
                                            <div class="comment_body">
                                                <div class="comment_header">
													<vte:value select="{comment_num}" /> |
													<vte:value select="{comment.get_author}" />
                                                </div>
												<div class="comment_title">
													<vte:value select="{comment.get_www}" />
												</div>
                                                <div class="comment_text"><vte:value select="{comment.get_description}" /></div>
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
														<vte:value select="{comment.create_dt|pretty_date}" />
													</span>
                                                </div>
                                            </div>
											<vte:if test="{VIVVO_COMMENTS_ENABLE_THREADED}">
												<div id="new_comment_holder_{comment.get_id}">  </div>
											</vte:if>
										</div>
									</vte:foreach>
								</vte:template>
							</vte:box>
						</vte:else>
					</vte:if>
				</vte:else>
			</vte:if>
			<vte:else>
				<script type="text/javascript">
					clearCommentDumps();
					<vte:foreach item="message" from="{DUMP_MESSAGES}">
						addCommentDump(<vte:value select="{message.get_message|json_encode}" />, <vte:value select="{message.type|json_encode}" />, <vte:value select="{message.additional_info|json_encode}" />);
					</vte:foreach>
				</script>
			</vte:else>
		</vte:if>
		<vte:else>
			<div id="comment_form_holder">
				<h4 class="title_comments"><vte:value select="{LNG_COMMENT_POST}" /></h4>
				<form method="post" id="comment_form" onsubmit="return updateComments();">
					<input type="hidden" name="action" value="comment" />
					<input type="hidden" name="cmd" value="add" />
					<vte:if test="{VIVVO_COMMENTS_ENABLE_THREADED}">
						<input type="hidden" id="COMMENT_reply_to" name="COMMENT_reply_to" value="" />
						<input type="hidden" id="COMMENT_root_comment" name="COMMENT_root_comment" value="" />
					</vte:if>
					<input type="hidden" name="COMMENT_article_id" value="{article.id}" />
					<div id="post-reply" class="box">
						<vte:if test="!{CURRENT_USER}">
							<div class="form_line">
								<label><vte:value select="{LNG_ADD_COMMENTS_AUTHOR}" />: </label>
								<div class="formElement">
									<input name="COMMENT_author" class="text default_fields" type="text" value="{USER_NAME}" />
								</div>
							</div>
						</vte:if>
						<div class="form_line">
							<label><vte:value select="عنوان التعليق" />: </label>
							<div class="formElement">
								<input name="COMMENT_www" class="text default_fields" type="text" value="{USER_MAIL}" />
							</div>
						</div>
						<vte:if test="{VIVVO_COMMENTS_ENABLE_THREADED}">
							<div id="writing_reply" style="display:none">
								<vte:value select="{LNG_COMMENT_REPLYING_TO}" />: <span id="writing_reply_to"> </span> <a href="javascript:;" onclick="cancelReplyTo();"><vte:value select="{LNG_CANCEL}" /></a>
							</div>
						</vte:if>
						<vte:if test="{VIVVO_COMMENTS_ENABLE_BBCODE}">
							<vte:header type="script" href="{VIVVO_URL}js/vivvo_bbcbox.js" />
							<div class="bbcodebox">
								<div class="form_line">
									<label><vte:value select="{LNG_ADD_COMMENTS}" />:</label>
									<div class="formElement">
										<ul class="bbc_buttons">
											<li><a href="javascript:;" class="tag_bold"><img src="{VIVVO_THEME_BANGTD}img/bbc_bold.png" alt="{LNG_COMMENTS_BBCODE_BOLD}" title="{LNG_COMMENTS_BBCODE_BOLD}" /></a></li>
											<li><a href="javascript:;" class="tag_italic"><img src="{VIVVO_THEME_BANGTD}img/bbc_italic.png" alt="{LNG_COMMENTS_BBCODE_ITALIC}" title="{LNG_COMMENTS_BBCODE_ITALIC}" /></a></li>
											<li><a href="javascript:;" class="tag_underline"><img src="{VIVVO_THEME_BANGTD}img/bbc_underline.png" alt="{LNG_COMMENTS_BBCODE_UNDERLINE}" title="{LNG_COMMENTS_BBCODE_UNDERLINE}" /></a></li>
											<li><a href="javascript:;" class="tag_quote"><img src="{VIVVO_THEME_BANGTD}img/bbc_quote.png" alt="{LNG_COMMENTS_BBCODE_QUOTE}" title="{LNG_COMMENTS_BBCODE_QUOTE}" /></a></li>
											<vte:if test="{CURRENT_USER}">
												<vte:variable name="bbc_link_onclick" value="$(this).up('.bbcodebox').down('.box_link').toggle().select('input').each(function(input){input.value='';})" literal="1" />
												<li><a href="javascript:;" onclick="{bbc_link_onclick}"><img src="{VIVVO_THEME_BANGTD}img/bbc_link.png" alt="{LNG_COMMENTS_BBCODE_INSERT_LINK}" title="{LNG_COMMENTS_BBCODE_INSERT_LINK}" /></a></li>
											</vte:if>
										</ul>
										<vte:if test="{CURRENT_USER}">
											<div class="box_link" style="display:none">
												<vte:value select="{LNG_COMMENTS_BBCODE_LINK_URL}" />: <input class="text tag_link_href default_fields" type="text" value="" /> <vte:value select="{LNG_COMMENTS_BBCODE_LINK_TEXT}" />: <input class="text tag_link_content default_fields" type="text" value="" /> <button type="button" class="comment_insert_button tag_link" onclick="$(this).up('.box_link').hide()"><vte:value select="{LNG_COMMENTS_BBCODE_INSERT_LINK}" /></button>
											</div>
										</vte:if>
										<textarea id="COMMENT_description" name="COMMENT_description" class="bbcodearea add_comment default_fields" rows="7" cols="40"> </textarea>
									</div>
								</div>
							</div>
							<vte:else>
								<div class="form_line">
									<label><vte:value select="{LNG_ADD_COMMENTS}" />:</label>
									<div class="formElement">
										<textarea class="add_comment default_fields" name="COMMENT_description" rows="7" cols="35" onfocus="this.value='';this.onfocus = null;"> </textarea>
									</div>
								</div>
							</vte:else>
						</vte:if>
						<div class="form_line">
							<label><!-- --></label>
							<div class="formElement">
								<input type="submit" class="button" value="{LNG_ADD_COMMENTS_BUTTON}" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</vte:else>
	</vte:if>
</vte:if>
