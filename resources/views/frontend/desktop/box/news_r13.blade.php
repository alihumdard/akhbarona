<div class="box1 box_white1">
	<vte:box module="box_article_list">
		<vte:params>
			<vte:param name="search_cid" value="16" />
			<vte:param name="search_sort_by" value="created" />
            <vte:param name="search_order" value="descending" />
			<vte:param name="search_limit" value="6" />
		</vte:params>
		<vte:template>
			<div id="category_news_box" >
				<div class="main_news_box_row">
                <h3 class="box_title_two title_two">مقالات وتقارير</h3>
				</div>
				<div id="latest_news_one" class="box_one box_white_one">
					<ul>
						<vte:foreach item = "article" from = "{article_list}" start="1" loop="1">
							<div class="short_one">
								<div class="short_holder_one">
									<vte:if test="{article.image}">
										<div class="image">
											<a href="{article.get_href}">
												<vte:if test="{article.get_image_caption}">
													<vte:variable name="image_caption" value="{article.get_image_caption}" />
													<vte:else>
														<vte:variable name="image_caption" value="{article.get_title}" />
													</vte:else>
												</vte:if>
												<img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_large}" width="180" height="135" alt="{image_caption}" /><br />
											</a>
										</div>
									</vte:if>
								<div class="clearer"> </div>
									<h2 class="article_title_one"><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h2>
								</div>
							</div>
						</vte:foreach>
						<vte:foreach item = "article" from = "{article_list}" start="2">
							<div class="short_one">
								<div class="short_holder_one">
									<vte:if test="{article.image}">
										<div class="image">
											<a href="{article.get_href}">
												<vte:if test="{article.get_image_caption}">
													<vte:variable name="image_caption" value="{article.get_image_caption}" />
													<vte:else>
														<vte:variable name="image_caption" value="{article.get_title}" />
													</vte:else>
												</vte:if>
												<img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_large}" width="180" height="135" alt="{image_caption}" /><br />
											</a>
										</div>
									</vte:if>
								<div class="clearer"> </div>
									<h2 class="article_title_one"><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h2>
								</div>
							</div>
						</vte:foreach>
						<div class="clearer"> </div>
					</ul>
				</div>
			</div>
		</vte:template>
	</vte:box>
</div>