<html xmlns="https://www.w3.org/1999/xhtml" lang="{VIVVO_LANG_CODE}" xml:lang="{VIVVO_LANG_CODE}" dir="rtl">
	<vte:include file="{VIVVO_TEMPLATE_DIR}system/html_header.tpl" />
	<vte:header type="keyword" value="{CURRENT_AUTHOR.get_keywords}" />
	<vte:header type="description" value="{CURRENT_AUTHOR.get_description}" />	
	<body id="layout_default">
		<div id="container">
			<vte:include file="{VIVVO_TEMPLATE_DIR}box/header.tpl" />
			<div id="content">
				<div id="dynamic_box_center">
					<div id="box_center_holder">
						<vte:box module="box_article_list" params = "{content_params}">
							<vte:template>
								<div>
									<vte:if test="{PAGE_TITLE}">
										<h1>
											<vte:value select="{PAGE_TITLE}" />
										</h1>
									</vte:if>
									<vte:include file="{VIVVO_TEMPLATE_DIR}box/author_info.tpl" />
									<div class="box_body" style="padding-top: 1.5em;">
										<vte:if test="{article_list}">
											<vte:foreach item = "article" from = "{article_list}">
												<vte:include file="{VIVVO_TEMPLATE_DIR}summary/title_only.tpl" />
											</vte:foreach>
											<vte:else>
												<vte:value select="{LNG_NO_ENTRIES}" />
											</vte:else>
										</vte:if>	
									</div>
								</div>
							</vte:template>
						</vte:box>
						<vte:include file="{VIVVO_TEMPLATE_DIR}box/author_publishing.tpl" />
					</div>
				</div>
			</div>
			<div id="footer">
				<vte:include file="{VIVVO_TEMPLATE_DIR}box/footer.tpl" />
			</div>
		</div>	
	</body>
</html>