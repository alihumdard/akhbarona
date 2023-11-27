<div class="box1 box_white1">
	<vte:box module="box_article_list">
		<vte:params>
			<vte:param name="search_cid" value="16" />
			<vte:param name="search_sort_by" value="created" />
            <vte:param name="search_order" value="descending" />
			<vte:param name="search_limit" value="4" />
		</vte:params>
		<vte:template>
			<div id="category_news_box" >
				<div class="main_news_box_row">
				<a title="المزيد في أخبار وطنية" href="{VIVVO_URL}national"><h3 class="box_title_policy title_policy">أخبار وطنية</h3></a>
				</div>
				<div id="latest_news_two" class="box_two box_white_two">
					<vte:foreach item = "article" from = "{article_list}">
						<vte:template>
							<div class="short_policy">
								<div class="short_holder_policy">
									<vte:if test="{article.image}">
										<div class="image">
											<a href="{article.get_href}">
												<vte:if test="{article.get_image_caption}">
													<vte:variable name="image_caption" value="{article.get_image_caption}" />
													<vte:else>
														<vte:variable name="image_caption" value="{article.get_title}" />
													</vte:else>
												</vte:if>
												<img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_large}" width="130" height="90" alt="{image_caption}" /><br />
											</a>
										</div>
									</vte:if>
									<h2 class="article_title_two_one"><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h2>
									<p>
										<vte:value select="{article.get_summary}" /> <vte:if test="{article.body}">...</vte:if>
										<vte:if test="!{article.get_link}">
											<vte:if test="{article.body}">
												<span class="mor_full"><a href="{article.get_href}"> <vte:value select="{LNG_FULL_STORY}" /></a></span>
											</vte:if>
											<vte:else>
												<a class="visit" href="{article.get_link}"><img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}" /></a>
											</vte:else>
										</vte:if>
									</p>
								</div>
							</div>
						</vte:template>
					</vte:foreach>
				</div>
			</div>
		</vte:template>
	</vte:box>
</div>