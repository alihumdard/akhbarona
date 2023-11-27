<vte:if test="{VIVVO_CATEGORIES_SHOW_SUBCATEGORIES}">
	<vte:box module="box_sections">
		<vte:params>
			<vte:param name="id" value="{CURRENT_CATEGORY.get_id}" />
		</vte:params>
		<vte:template>
			<div class="main_news_box_holder">
				<vte:for from="{categories}" step="2" key="category_index">
					<div class="main_news_box_row">
						<vte:foreach item = "category" from = "{categories}" loop="2" start="{category_index}" key="col">
                        	<div class="main_news_category cell_{col|mod:'2'}">
                                <vte:if test="{category.category_name}">
                                    <vte:box module="box_article_list">
                                        <vte:params>
                                            <vte:param name="search_sort_by" value="created" />
                                            <vte:param name="limit" value="{VIVVO_MODULES_MORE_NEWS_ARTICLE_NUMBER}" />
                                            <vte:param name="search_cid" value="{category.id}" />
                                            <vte:param name="add_to_printed" value="true" />
                                            <vte:param name="exclude_printed" value="true" />
                                        </vte:params>
                                        <vte:template>
                                            <vte:if test="{article_list}">
                                                <div id="box_more_category_list_{category.get_id}">
                                                    <h3 class="box_title title_gray">
                                                        <a href="{category.get_href}">
                                                            <vte:if test="{category.image}">
                                                                <img src="{VIVVO_STATIC_URL}files.php?file={category.get_image}" alt="{category.get_category_name}" />
                                                            </vte:if> 
                                                            <vte:value select="{category.get_category_name}" />
                                                        </a>
                                                    </h3>
                                                    <ul>
                                                        <vte:foreach item = "article" from = "{article_list}">
                                                            <li><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></li>
                                                        </vte:foreach>
                                                    </ul>
                                                </div>
                                            </vte:if>
                                        </vte:template>
                                    </vte:box>
                                </vte:if>
                            </div>
						</vte:foreach>
					</div>
				</vte:for>
			</div>
		</vte:template>
	</vte:box>
</vte:if>