<vte:box module="box_pages">
	<vte:params>
		<vte:param name="cache" value="1" />
	</vte:params>
	<vte:template>
		<div class="box_pages">
			<ul>
				<li><a href="{VIVVO_URL}"><vte:value select="{LNG_GO_HOME}" /></a></li>
				<li><a href="{VIVVO_PROXY_URL}">Mobile <vte:value select="{LNG_GO_HOME}" /></a></li>
				<vte:foreach item="page" from="{page_list}">
					<li><a href="{page.get_href}"><vte:value select="{page.title}" /></a></li>
				</vte:foreach>
			</ul>
		</div>
	</vte:template>
</vte:box>