<vte:template>
	<vte:header type="script" href="{VIVVO_URL}js/framework/effects.js" />
	<vte:header type="script" href="{VIVVO_URL}js/accordion.js" />
	<vte:header type="css" href="{VIVVO_THEME}css/accordion.css" />
	<vte:box module="box_article_list">
		<vte:params>
			<vte:param name="search_sort_by" value="order_num" />
			<vte:param name="search_order" value="descending" />
			<vte:param name="search_limit" value="4" />
			<vte:param name="cache" value="1" />
			<vte:param name="add_to_printed" value="true" />
			<vte:param name="exclude_printed" value="true" />
		</vte:params>
		<vte:template>
		<div id="horizontal_container_holder">
			<div id="horizontal_container" class="sidebox" style="width:10000px;">
				<vte:foreach item = "article" from = "{article_list}" key="index">
					<div class="horizontal_accordion_toggle">
						<vte:if test="{article.image}">
                            <div class="image">
                                <a href="{article.get_href}">
                                    <vte:if test="{article.get_image_caption}">
                                        <vte:variable name="image_caption" value="{article.get_image_caption}" />
                                        <vte:else>
                                            <vte:variable name="image_caption" value="{article.get_title}" />
                                        </vte:else>
                                    </vte:if>
                                    <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_large}" alt="{image_caption}" /><br />
                                </a>
                            </div>
                        </vte:if>
						<div class="image_caption"><vte:value select="{article.get_image_caption}" /></div>
					</div>
					<div class="horizontal_accordion_content">
						<div class="horizontal_accordion_content_holder">
							<h4><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h4>
							<vte:value select="{article.get_summary}" />
						</div>
					</div>
				</vte:foreach>
			</div>
		</div>
		</vte:template>
	</vte:box>
	<script type="text/javascript">
		//<vte:cdata>
		(function() {
			var a = new accordion('horizontal_container', {
				classNames: {
					toggle: 'horizontal_accordion_toggle',
					toggleActive: 'handle_active',
					content: 'horizontal_accordion_toggle_active'
				},
				defaultSize: {
					width: 304
				},
				direction: 'horizontal',
				onEvent: 'mouseover'
			});
			var items = $$('#horizontal_container .horizontal_accordion_toggle');
			if (items.length) {
				a.activate(items[0]);
			}
		})();
		//</vte:cdata>
	</script>
</vte:tempalte>