<html xmlns="https://www.w3.org/1999/xhtml" lang="{VIVVO_LANG_CODE}" xml:lang="{VIVVO_LANG_CODE}" dir="rtl">
	<vte:include file="{VIVVO_TEMPLATE_DIR}system/html_header.tpl" />
	<vte:include file="{VIVVO_TEMPLATE_DIR}box/header.tpl" />
	<vte:header type="css" href="{VIVVO_THEME}css/article_styles.css" />
	<vte:header type="css" href="{VIVVO_THEME}css/print.css" media="print" />
	<vte:header type="keyword" value="{article.get_keywords}" />
	<vte:header type="description" value="{article.get_description}" />
	<body id="layout_two_column">
		<div id="container">
			<vte:include file="{VIVVO_TEMPLATE_DIR}box/ticker_typer.tpl" />
            <div class="page_top"> </div>
			<div id="content">
				<div id="dynamic_box_center">
					<div id="box_center_holder">
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/article_breadcrumb.tpl" />
						<div id="article_holder">
							<h1 class="page_title"><vte:value select="{article.get_title}" /></h1>
							<div class="story_stamp">
                            	<vte:if test="{VIVVO_ARTICLE_SHOW_AUTHOR}">
									<vte:if test="{VIVVO_ARTICLE_SHOW_AUTHOR_INFO}">
										<vte:value select="{LNG_AUTHOR_BY}" /> <span class="story_author"><a href="{article.get_author_href}"><vte:value select="{article.get_author_name}" /></a></span>
										<vte:else>
											<vte:value select="{LNG_AUTHOR_BY}" /> <span class="story_author"><vte:value select="{article.get_author_name}" /></span>
										</vte:else>
									</vte:if>
								</vte:if>
								<vte:if test="{VIVVO_ARTICLE_SHOW_DATE}">
									<span class="story_date"><vte:value select="{article.created|pretty_date}" /></span>
								</vte:if>
							</div>
                            <div class="article_retweet">
								<script type="text/javascript">
                                    tweetmeme_style = 'compact';
                                </script>
                                <script type="text/javascript" src="https://tweetmeme.com/i/scripts/button.js"> </script>
                            </div>
							<vte:include file="{VIVVO_TEMPLATE_DIR}box/font_size.tpl" />
							<div id="article_body">
								<vte:if test="{article.image}">
									<div class="image" style="width:{VIVVO_ARTICLE_MEDIUM_IMAGE_WIDTH}px;">
										<vte:if test="{article.get_image_caption}">
                                            <vte:variable name="image_caption" value="{article.get_image_caption}" />
                                            <vte:else>
                                                <vte:variable name="image_caption" value="{article.get_title}" />
                                            </vte:else>
                                        </vte:if>
										<img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_medium}" alt="{image_caption}" />
										<span class="image_caption"><vte:value select="{article.get_image_caption}" /></span>
									</div>
									<div style="clear:both;">&nbsp;</div>
								</vte:if>
                                <vte:if test="{article.get_abstract}">
                                    <p class="article_abstract"><vte:value select="{article.get_abstract}" /></p>
                                </vte:if>
								<vte:value select="{article.get_body}" />
							</div>
                            <vte:if test="{article.get_link}">
                                <p><a class="visit" href="{article.get_link}"><vte:value select="{LNG_FULL_STORY}" /> <img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}" /></a></p>
                            </vte:if>
							<vte:include file="{VIVVO_TEMPLATE_DIR}box/article_social_bookmarks.tpl" />
							<vte:if test="{article.show_comment}">
								<vte:include file="{VIVVO_TEMPLATE_DIR}box/{VIVVO_COMMENTS_BOX_TEMPLATE}" />
							</vte:if>
						</div>
					</div>
				</div>
				<div id="dynamic_box_right">
					<div id="box_right_holder">
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/article_tools.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/article_social_bookmarks.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/blog_author_info.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/article_tags.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_image_gallery_lightbox.tpl" />
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/article_vote.tpl" nocache="1" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/related_news.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/category_related.tpl" />
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_multiple_attachments.tpl" />
					</div>
				</div>
			</div>
			<div class="footer_banner"><<vte:include file="{VIVVO_TEMPLATE_DIR}adv/footer_top.tpl" /></div>
			<div id="footer">
				<vte:include file="{VIVVO_TEMPLATE_DIR}box/footer.tpl" />
			</div>
		</div>
		<vte:if test="{VIVVO_ANALYTICS_TRACKER_ID}">
			<script type="text/javascript">_gaq.push(['_trackEvent', 'Article', 'View', '<vte:value select="{article.get_id}" />', 1]);</script>
		</vte:if>
	</body>
</html>