<vte:template>
	<div class="">
		<vte:header type="css" href="{VIVVO_THEME}css/article_stripe.css" />
		<vte:header type="script" href="{VIVVO_URL}js/framework/effects.js" />
		<vte:header type="script" href="{VIVVO_URL}js/glider.js" />
		<div class="box">
			<div class="main_news_box_row">
				<a title="المزيد في كاريكاتير وصورة" href="{VIVVO_URL}caricature"><h3 class="box_title_two title_two">كاريكاتير وصورة</h3></a>
			</div>
			<div id="latest_news_two" class="box_caric box_white_caric">
				<div class="box_content">
					<vte:box module="box_article_list">
						<vte:params>
							<vte:param name="cache" value="1" />
							<vte:param name="search_order" value="descending" />
							<vte:param name="search_limit" value="1" />
							<vte:param name="search_cid" value="35" />
						</vte:params>            
						<vte:template>
							<div id="article_category_stripe">
								<div id="article_category_stripe_stripe_body" style="width:100%; overflow:hidden;">
									<div class="scroller">
										<div class="content">
											<vte:for from="{article_list}" step="3" key="strip_index">
												<div id="article_category_stripe_section{strip_index}" class="section">
													<vte:foreach item = "article" key="index" from = "{article_list}" start="{strip_index}" loop="3">
														<h2 class="article_title_caric"><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h2>
														<div class="stripe_summary_holder">
															<vte:if test="{article.image}">
																<div class="image"><a href="{article.get_href}"><img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_large}" width="278" height="200" alt="صورة" /></a></div>
															</vte:if>
														</div>
													</vte:foreach>
												</div>
											</vte:for>
										</div>
									</div>
								</div>
							</div>
						<vte:template>
					</vte:box>
				</div>
			</div>
		</div>
	</div>
</vte:template>
