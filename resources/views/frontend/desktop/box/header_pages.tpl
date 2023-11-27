<div id="header">
	<vte:include file="{VIVVO_TEMPLATE_DIR}box/explorer.html" />
	<div class="header_image">
		<div id="containers">
		<vte:include file="{VIVVO_TEMPLATE_DIR}box/top_bar.tpl" />
			<a href="{VIVVO_URL}"><img src="{VIVVO_THEME_BANGTD}img/logo.png" alt="{VIVVO_WEBSITE_TITLE}" title="{VIVVO_WEBSITE_TITLE}" /></a>
			<div class="banner"><vte:load module="box_banners" search_zone_id="19" /></div>
			<div class="clearer"> </div>
			<vte:if test="{VIVVO_MODULES_DHTML_SECTIONS}">
				<vte:include file="{VIVVO_TEMPLATE_DIR}box/main_nav.tpl" />
			</vte:if>
		</div>
	</div>
	<div class="clearer"> </div>
</div>