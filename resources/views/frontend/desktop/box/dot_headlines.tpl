<vte:if test="{VIVVO_MODULES_HEADLINES_DISPLAY}">
	<vte:header type="script" href="{VIVVO_URL}js/rotating_headlines.js" />
	<vte:header type="css" href="{VIVVO_THEME}css/dot_headlines.css" />
	<vte:box module="box_article_list">
		<vte:params>
            <vte:param name="search_topic_id" value="1" />
            <vte:param name="search_all_tag_ids" value="1,2" />
			<vte:param name="search_sort_by" value="order_num" />
			<vte:param name="search_order" value="descending" />
			<vte:param name="cache" value="1" />
			<vte:param name="add_to_printed" value="true" />
			<vte:param name="exclude_printed" value="true" />
		</vte:params>
		<vte:template>
			<div id="headline">
				<div id="rotating_headlines" class="box_headline">
					<vte:foreach item = "article" from = "{article_list}" key="index">
                        <div id="rotating_headlines_{index}" class="headline_article_holder">
                            <vte:attribute name="style">
                                <vte:if test="{index} != 1">display:none;</vte:if>
                            </vte:attribute>
                            <div class="headline_image">
                                <vte:if test="{article.image}">
                                	<div id="headline_image_big">
                                        <a href="{article.get_href}">
                                            <vte:if test="{article.get_image_caption}">
                                                <vte:variable name="image_caption" value="{article.get_image_caption}" />
                                                <vte:else>
                                                    <vte:variable name="image_caption" value="{article.get_title}" />
                                                </vte:else>
                                            </vte:if>
                                            <img id="defaultDemo" src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_large}" alt="{image_caption}" />
                                        </a>
                                    </div>
                                </vte:if>
                                <div id="rotating_headlines_article_{index}" class="headline_short">
                                    <h2 class="article_title"><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h2>
                                    <vte:value select="{article.get_summary}" />
                                </div>
                            </div>
                        </div>	
					</vte:foreach>
					<div class="player">
						<ul id="rotating_headlines_player">
							<vte:foreach item = "article" from = "{article_list}" key="index">
								<li><a href="#rotating_headlines_{index}"> </a></li>	
							</vte:foreach>
						</ul>
                        <div class="clearer"> </div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				var rotating_headlines_tabs = new vivvoRotatingHeadlines('rotating_headlines', <vte:value select="{VIVVO_MODULES_HEADLINES_ROTATION_TIME}" />);
			</script>
		</vte:template>
	</vte:box>
</vte:if>