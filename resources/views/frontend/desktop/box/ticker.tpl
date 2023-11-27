<vte:if test="{VIVVO_MODULES_TICKER}">
	<vte:header type="script" href="{VIVVO_URL}js/framework/effects.js" />
	<vte:header type="script" href="{VIVVO_URL}js/glider.js" />
	<vte:header type="script" href="{VIVVO_URL}js/ticker.js" />
	<vte:box module="box_article_list">
		<vte:params>
			<vte:param name="search_sort_by" value="{VIVVO_MODULES_TICKER_ORDER}" />
			<vte:param name="search_limit" value="{VIVVO_MODULES_TICKER_NUMBER}" />
			<vte:param name="fields" value="title,SEfriendly,category_id" />
			<vte:param name="search_cid" value="{VIVVO_MODULES_TICKER_CATEGORIES}" />
			<vte:param name="cache" value="1" />
		</vte:params>
		<vte:template>
			<div id="mainTicker" class="ticker">
				<div style="overflow:hidden;" class="scroller">
					<vte:foreach item = "article" from = "{article_list}">
						<div id="ticker_{article.id}" class="section">
							<span class="ticker_category"><a href="{article.get_category_href}"><vte:value select="{article.get_category_name}" /></a> - </span>
							<a href="{article.get_href}"><vte:value select="{article.get_title}" /></a>
						</div>
					</vte:foreach>
				</div>
			</div>
			<script type="text/javascript">
				var mainTicker = new vivvoTicker('mainTicker');
			</script>
		</vte:template>
	</vte:box>
</vte:if>