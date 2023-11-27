<html xmlns="https://www.w3.org/1999/xhtml" lang="{VIVVO_LANG_CODE}" xml:lang="{VIVVO_LANG_CODE}">
	<vte:include file="{VIVVO_TEMPLATE_DIR}system/html_header.tpl" />
	<vte:header type="css" href="{VIVVO_THEME}css/article_styles.css" />
	<vte:header type="css" href="{VIVVO_THEME}css/print.css" media="print" />
	<vte:header type="keyword" value="{article.get_keywords}" />
	<vte:header type="description" value="{article.get_description}" />
	<body id="layout_default">
		<div id="container">
			<vte:include file="{VIVVO_TEMPLATE_DIR}box/header.tpl" />
			<div id="content">
				<div id="dynamic_box_left">
					<div id="box_left_holder">
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/sections.tpl" />
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_newsletter.tpl" />
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_poll.tpl" />
					</div>
				</div>
				<div id="dynamic_box_center">
					<div id="box_center_holder">
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/article_breadcrumb.tpl" />
						<div id="article_holder">
							<h1><vte:value select="{article.get_title}" /></h1>
							<div class="article_metadata">
								<vte:if test="{VIVVO_ARTICLE_SHOW_DATE}">
									<span class="metadata_time"><vte:value select="{article.get_created}" /></span>
								</vte:if> 
								<vte:if test="{VIVVO_ARTICLE_SHOW_AUTHOR}">
									<vte:if test="{VIVVO_ARTICLE_SHOW_AUTHOR_INFO}">
										<a href="{article.get_author_href}"><vte:value select="{article.get_author_name}" /></a>
										<vte:else>
											<vte:value select="{article.get_author_name}" />
										</vte:else>
									</vte:if>
								</vte:if> 
							</div>
							<vte:include file="{VIVVO_TEMPLATE_DIR}box/font_size.tpl" />
							<div id="article_body">
                            	<vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_image_gallery_stripe.tpl" />
								<vte:if test="{article.image}">
									<div class="image" style="width:{VIVVO_ARTICLE_MEDIUM_IMAGE_WIDTH}px;">
										<img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_medium}" alt="image" />
										<span class="image_caption"><vte:value select="{article.get_image_caption}" /></span>
									</div>
								</vte:if>
								<p><strong><vte:value select="{article.get_abstract}" /></strong></p>
								<vte:value select="{article.get_body}" />
							</div>
							<vte:if test="{article.get_document}">
								<div class="content_attachment">
									<img src="{VIVVO_THEME_BANGTD}img/attachment.gif" alt="{LNG_DOWNLOAD_ATTACHMENT}" />
									<vte:value select="{LNG_DOWNLOAD_ATTACHMENT}" /> >> 
									<a href="{article.get_document_href}"><vte:value select="{article.get_document}" /></a>
								</div>
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
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_image_gallery_lightbox.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_multiple_attachments.tpl" />
						<div id="article_tags">
							<vte:include file="{VIVVO_TEMPLATE_DIR}box/article_tags.tpl" />
						</div>
						<vte:if test="{VIVVO_ARTICLE_RATING_MEMBER_ONLY}">
							<vte:if test="{CURRENT_USER}">
								<vte:include file="{VIVVO_TEMPLATE_DIR}box/article_vote.tpl" />
							</vte:if>
							<vte:else>
								<vte:include file="{VIVVO_TEMPLATE_DIR}box/article_vote.tpl" />
							</vte:else>
						</vte:if>
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/related_news.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_review_games.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_review_movie.tpl" />
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_review_music.tpl" />
					</div>
				</div>
			</div>
			<div id="footer">
				<vte:include file="{VIVVO_TEMPLATE_DIR}box/footer.tpl" />
			</div>
		</div>	
	</body>
</html>
