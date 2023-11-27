<ul>
	<vte:foreach item="page" from="{page_list}">
		<li>
			<a href="{page.get_href}"><vte:value select="{page.title}" /></a>
		</li>
	</vte:foreach>
</ul>