<vte:template>
	<vte:header type="script" href="{VIVVO_URL}js/framework/effects.js" />
	<vte:header type="script" href="{VIVVO_URL}js/accordion.js" />
	<vte:header type="css" href="{VIVVO_THEME}css/accordion.css" />
	<vte:box module="box_article_list">
		<vte:params>
			<vte:param name="search_sort_by" value="order_num" />
			<vte:param name="search_order" value="descending" />
			<vte:param name="search_limit" value="6" />
			<vte:param name="cache" value="1" />
			<vte:param name="add_to_printed" value="true" />
			<vte:param name="exclude_printed" value="true" />
		</vte:params>
		<vte:template>
            <h3 class="box_title title_white">آخر الأخبار</h3>
			<div id="vertical_container">
				<vte:foreach item = "article" from = "{article_list}" key="index">
					<div class="vertical_accordion_toggle">
						<h4><span class="story_date_sw"><vte:value select="{article.created|format_date:'h:i'}" /></span><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h4>
					</div>
					<div class="vertical_accordion_content">
						<div class="vertical_accordion_content_holder">
                        	<vte:if test="{article.image}">
                                <div class="image">
                                    <a href="{article.get_href}">
                                        <vte:if test="{article.get_image_caption}">
                                            <vte:variable name="image_caption" value="{article.get_image_caption}" />
                                            <vte:else>
                                                <vte:variable name="image_caption" value="{article.get_title}" />
                                            </vte:else>
                                        </vte:if>
                                        <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_large}" width="170" height="115" alt="{image_caption}" /><br />
                                    </a>
                                </div>
                            </vte:if>
						</div>
					</div>
				</vte:foreach>
			</div>
		</vte:template>
	</vte:box>
	<script type="text/javascript">
		//<vte:cdata>
		(function() {
			var a = new accordion('vertical_container', {
				classNames: {
					toggle: 'vertical_accordion_toggle',
					toggleActive: 'vertical_active',
					content: 'vertical_accordion_toggle_active'
				},
				defaultSize: {
					height: 100
				},
				direction: 'vertical',
				onEvent: 'mouseover'
			});
			var items = $$('#vertical_container .vertical_accordion_toggle');
			if (items.length) {
				a.activate(items[0]);
			}
		})();
		//</vte:cdata>
	</script>
</vte:template>