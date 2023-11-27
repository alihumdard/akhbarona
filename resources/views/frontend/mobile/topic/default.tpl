<html xmlns="https://www.w3.org/1999/xhtml" lang="{VIVVO_LANG_CODE}" xml:lang="{VIVVO_LANG_CODE}" dir="rtl">
	<vte:include file="{VIVVO_TEMPLATE_DIR}system/html_header.tpl" />
	<body id="layout_default">
		<div id="container">
			<vte:include file="{VIVVO_TEMPLATE_DIR}box/header.tpl" />
			<div id="content">
				<div id="dynamic_box_center">
					<div id="box_center_holder">
						<div id="label_holder">
							<h1 class="page_title"><vte:value select="{topic.get_name}" /></h1>
							<ul>
								<vte:foreach from="{topic.get_tags}" item="label">
									<li><a href="{label.get_href}"><vte:value select="{label.get_name}" /></a></li>
								</vte:foreach>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div id="footer">
				<vte:include file="{VIVVO_TEMPLATE_DIR}box/footer.tpl" />
			</div>
		</div>
	</body>
</html>
