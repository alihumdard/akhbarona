<vte:template>
	<div class="box_art box_white_art">
		<vte:header type="css" href="{VIVVO_THEME}css/article_stripe.css" />
		<vte:header type="script" href="{VIVVO_URL}js/framework/effects.js" />
		<vte:header type="script" href="{VIVVO_URL}js/glider.js" />
		<div class="box">
			<div class="box_title_holder">
				<h3 class="box_title title_gray">الكاريكاتير <vte:value select="{article.get_category_name}" /></h3>
			</div>
			<div class="box_body">
				<div class="box_content">
					<vte:box module="box_article_list">
						<vte:params>
							<vte:param name="cache" value="1" />
							<vte:param name="search_order" value="descending" />
							<vte:param name="search_limit" value="6" />
							<vte:param name="search_cid" value="{article.get_category_id}" />
						</vte:params>            
						<vte:template>
							<div id="article_category_stripe">
								<div id="article_category_stripe_stripe_body" style="width:100%; overflow:hidden;">
									<div class="control_arrow">
										<span class="section_next" onclick="my_glider.previous();" style="cursor:pointer;"><img src="{VIVVO_THEME_BANGTD}img/article_scroller_back.gif" alt="السابق" title="السابق" /></span>
									</div>
									<div class="scroller">
										<div class="content">
											<vte:for from="{article_list}" step="3" key="strip_index">
												<div id="article_category_stripe_section{strip_index}" class="section">
													<vte:foreach item = "article" key="index" from = "{article_list}" start="{strip_index}" loop="3">
														<div class="stripe_summary_holder">
															<vte:if test="{article.image}">
																<div class="image"><a href="{article.get_href}"><img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_large}" width="244" height="200" alt="صورة" /></a></div>
															</vte:if>
														</div>
													</vte:foreach>
												</div>
											</vte:for>
										</div>
									</div>
									<div class="control_arrow arrow_bottom">
										<span onclick="my_glider.next();" style="cursor:pointer;"><img src="{VIVVO_THEME_BANGTD}img/article_scroller_next.gif" alt="التالي" title="التالي" /></span>
									</div>
								</div>
							</div>
							<script>
								$$('#<vte:value select="article_category_stripe" />_box_stripes .stripe_summary_text_holder').each(
									function (short){
										var summary = short.getElementsByClassName('summary')[0];
										if (summary) resizeShort(short, summary);
									}
								);
								var my_glider = new Glider('<vte:value select="article_category_stripe" />_stripe_body', {duration:0.5});
							</script>
						<vte:template>
					</vte:box>
				</div>
			</div>
		</div>
	</div>
</vte:template>
