<html xmlns="https://www.w3.org/1999/xhtml" lang="{VIVVO_LANG}" xml:lang="{VIVVO_LANG}" dir="rtl">
	<vte:include file="{VIVVO_TEMPLATE_DIR}system/html_header.tpl" />
	<vte:include file="{VIVVO_TEMPLATE_DIR}box/header.tpl" />
	<body id="layout_two_column">
		<div id="container">
			<vte:include file="{VIVVO_TEMPLATE_DIR}box/ad_tabs_right.tpl" />
			<vte:include file="{VIVVO_TEMPLATE_DIR}box/ticker_typer.tpl" />
            <div class="page_top"> </div>
			<div id="content">
				<div id="dynamic_box_center">
					<div id="box_center_holder">
                    	<vte:include file="{VIVVO_TEMPLATE_DIR}box/category_breadcrumb.tpl" />
                        <vte:if test="{PAGE_TITLE}">
                            <h1 class="page_title"><vte:value select="{PAGE_TITLE}" /></h1>
                        </vte:if>
                        <vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_video_player.tpl" />
					</div>
				</div>
				<div id="dynamic_box_right">
					<div id="box_right_holder">
						<!--<vte:include file="{VIVVO_TEMPLATE_DIR}{VIVVO_LOGIN_TEMPLATE}" nocache="1" />-->
					</div>
				</div>
			</div>
            <vte:include file="{VIVVO_TEMPLATE_DIR}box/plugin_video_tabs.tpl" />
			<div class="footer_banner"><vte:include file="{VIVVO_TEMPLATE_DIR}adv/footer_top.tpl" /></div>
			<div id="footer">
				<vte:include file="{VIVVO_TEMPLATE_DIR}box/footer.tpl" />
			</div>
		</div>
        <vte:if test="{VIVVO_ANALYTICS_TRACKER_ID}">
			<script type="text/javascript">_gaq.push(['_trackEvent', 'Category', 'View', '<vte:value select="{category.get_id}" />', 1]);</script>
		</vte:if>
	</body>
</html>