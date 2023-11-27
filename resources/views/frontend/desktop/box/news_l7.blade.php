<vte:template>
	<vte:header type="script" href="{VIVVO_URL}js/framework/effects.js" />
    <vte:header type="script" href="{VIVVO_URL}js/glider.js" />
    <vte:header type="script" href="{VIVVO_URL}js/ticker.js" />
    <vte:header type="css" href="{VIVVO_THEME}css/ticker_v_2.css" />
	<div class="white_box_24">
		<div class="white_box_top_24"><!--fds--></div>
		<div class="white_box_mid_24">
			<div class="box box_white">
				<h3 class="box_title title_gray">حوادث وقضايا</h3>
				<vte:if test="{VIVVO_MODULES_TICKER}">
					<vte:box module="box_article_list">
						<vte:params>
							<vte:param name="search_sort_by" value="{VIVVO_MODULES_TICKER_ORDER}" />
							<vte:param name="limit" value="{VIVVO_MODULES_TICKER_NUMBER}" />
							<!--<vte:param name="search_cid" value="18" />-->
							<vte:param name="search_cid" value="18" />
							<vte:param name="search_limit" value="10" />
							<vte:param name="cache" value="1" />
						</vte:params>
						<vte:template>
							<div id="mainTicker" class="ticker_summary">
								<div style="overflow:hidden;" class="scroller">
									<vte:foreach item = "article" key="index" from = "{article_list}" start="{strip_index}">
										<div id="ticker_{article.id}" class="section row_{index|mod:'2'}">
											<vte:template>
												<vte:if test="{article.image}">
													<div class="image">
														<a href="{article.get_href}"><img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_small}" width="50" height="40" alt="image" /><br /></a>
													</div>
												</vte:if>
												<h3><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h3>
												<--<div class="ticker_date">
												<vte:value select="{article.created|format_date:'h:i'}" />
												<span><vte:value select="{article.created|format_date:'Y-m-d'}" /></span>-->
												</div>
											</vte:template>
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
			</div>
		</div>
		<div class="white_box_bottom_24"><!--fds--></div>
	</div>
</vte:template>