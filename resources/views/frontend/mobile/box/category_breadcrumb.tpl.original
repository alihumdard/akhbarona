<vte:if test="{CURRENT_CATEGORY}">
	<div class="box_breadcrumb">
		<a href="{VIVVO_PROXY_URL}"><vte:value select="{LNG_GO_HOME}" /></a> |
		<vte:foreach item="crumb" from="{CURRENT_CATEGORY.get_breadcrumb}" key="index">
			<vte:if test="{index} = {index_count}">
				<vte:value select="{crumb.get_category_name}" />
				<vte:else>
					<a href="{crumb.get_href}"><vte:value select="{crumb.get_category_name}" /></a> |
				</vte:else>
			</vte:if>
		</vte:foreach>
	</div>
</vte:if>