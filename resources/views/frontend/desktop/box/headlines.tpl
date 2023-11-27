<vte:if test="{VIVVO_MODULES_HEADLINES_DISPLAY}">
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
			<div id="static_headlines">
                <vte:foreach item = "article" from = "{article_list}" key="index" start="1" loop="1">
                    <div class="static_headline_holder">
                        <vte:if test="{article.image}">
                            <div class="static_headline_image">
                                <a href="{article.get_href}">
                                    <vte:if test="{article.get_image_caption}">
                                        <vte:variable name="image_caption" value="{article.get_image_caption}" />
                                        <vte:else>
                                            <vte:variable name="image_caption" value="{article.get_title}" />
                                        </vte:else>
                                    </vte:if>
                                    <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_medium}" alt="{image_caption}" /><br />
                                </a>
                            </div>
                        </vte:if>
                        <h1 class="article_title headline_title">
                            <a href="{article.get_href}"><vte:value select="{article.get_title}" /></a>
                        </h1>
                        <p>
                            <vte:value select="{article.get_summary}" /><vte:if test="{article.body}">...</vte:if>
                            <vte:if test="!{article.get_link}">
                                <vte:if test="{article.body}">
                                    <a href="{article.get_href}"> <vte:value select="{LNG_FULL_STORY}" /></a>
                                </vte:if>
                                <vte:else>
                                    <a class="visit" href="{article.get_link}"><img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}"/></a>
                                </vte:else>
                            </vte:if>
                        </p>
                    </div>
                </vte:foreach>
                <vte:foreach item = "article" from = "{article_list}" key="index" start="2" loop="4">
                    <h2 class="article_title"><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h2>
                    <div class="static_headline_holder">
                        <p>
                            <vte:value select="{article.get_summary}" /><vte:if test="{article.body}">...</vte:if>
                            <vte:if test="!{article.get_link}">
                                <vte:if test="{article.body}">
                                    <a href="{article.get_href}"> <vte:value select="{LNG_FULL_STORY}" /></a>
                                </vte:if>
                                <vte:else>
                                    <a class="visit" href="{article.get_link}"><img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}"/></a>
                                </vte:else>
                            </vte:if>
                        </p>
                    </div>
                </vte:foreach>
			</div>
		</vte:template>
	</vte:box>
</vte:if>