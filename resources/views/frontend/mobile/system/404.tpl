<html xmlns="https://www.w3.org/1999/xhtml" lang="{VIVVO_LANG}" xml:lang="{VIVVO_LANG}" dir="rtl">
	<vte:include file="{VIVVO_TEMPLATE_DIR}system/html_header.tpl" />
	<body id="layout_default">
		<div id="container">
			<div id="content" style="padding: 2em; text-align:center">
				<div id="dynamic_box_center">
					<div style="padding: 1.5em;">
						<h1 style="font-size:3em;"><vte:value select="{LNG_404_NOT_FOUND}" /></h1>
						<div style=" font-size: 1.3em; padding: 0.2em;"><vte:value select="{LNG_404_NOT_FOUND_INFO}" /></div>
						<strong><a href="{VIVVO_PROXY_URL}"><vte:value select="{LNG_404_GO_HOME}" /></a></strong>
					</div>
					<div id="box_search" class="search" style="text-align:center;">
						<form action="{VIVVO_PROXY_URL}search.html" method="post" name="search">
							<input type="hidden" name="search_do_advanced" />
							<input value="" class="text" type="text" name="search_query" id="search_query" />
							<button type="submit" name="search" value="0"><vte:value select="{LNG_SEARCH_BUTTON}" /></button> |
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>