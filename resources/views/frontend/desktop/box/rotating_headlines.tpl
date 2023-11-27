<vte:if test="{VIVVO_MODULES_HEADLINES_DISPLAY}">
	<vte:header type="script" href="{VIVVO_URL}js/rotating_headlines.js" />
	<vte:header type="css" href="{VIVVO_THEME}css/rotating_headlines.css" />
	<vte:box module="box_article_list">
		<vte:params>
            <vte:param name="search_topic_id" value="1" />
            <vte:param name="search_all_tag_ids" value="1,2" />
			<vte:param name="search_sort_by" value="order_num" />
			<vte:param name="search_order" value="descending" />
			<vte:param name="cache" value="1" />
			<vte:param name="add_to_printed" value="true" />
			<vte:param name="exclude_printed" value="true" />
			<vte:param name="search_limit" value="14" />
		</vte:params>
		<vte:template>
			<div id="headline">
				<div id="rotating_headlines" class="box_headline">
					<vte:foreach item = "article" from = "{article_list}" key="index">
                        <div id="rotating_headlines_{index}" class="headline_article_holder">
                            <vte:attribute name="style">
                                <vte:if test="{index} != 1">display:none;</vte:if>
                            </vte:attribute>
                                <h1 class="article_title_sw">
                                    <a href="{article.get_href}"><vte:value select="{article.get_title}" /></a>
                                </h1>
                            <vte:if test="{article.image}">
                                <div class="headline_image">
                                    <a href="{article.get_href}">
                                        <vte:if test="{article.get_image_caption}">
                                            <vte:variable name="image_caption" value="{article.get_image_caption}" />
                                            <vte:else>
                                                <vte:variable name="image_caption" value="{article.get_title}" />
                                            </vte:else>
                                        </vte:if>
                                        <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_large}" width="600" height="400" alt="{image_caption}" />
                                    </a>
                                    <div class="image_caption"><vte:value select="{article.get_image_caption}" /></div>
                                </div>
                            </vte:if>
                            <div id="rotating_headlines_article_{index}" style="height:101px;">
                                <div class="headline_body"><vte:value select="{article.get_summary}" /></div>
                                <div class="article_link_more"><a href="{article.get_href}"><vte:value select="{LNG_FULL_STORY}" /></a></div>
                            </div>
                        </div>	
					</vte:foreach>
					<div class="player">
						<ul id="rotating_headlines_player">
							<vte:foreach item = "article" from = "{article_list}" key="index">
								<li><a href="#rotating_headlines_{index}"><vte:value select="{index}" /></a></li>	
							</vte:foreach>
						</ul>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				var rotating_headlines_tabs = new vivvoRotatingHeadlines('rotating_headlines', <vte:value select="{VIVVO_MODULES_HEADLINES_ROTATION_TIME}" />);
			</script>
		</vte:template>
	</vte:box>
	<div class="clearer"> </div>
</vte:if>