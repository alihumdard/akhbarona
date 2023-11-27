<ul>
	<vte:foreach from="{user_list}" item="user">
		<li>
			<a href="{user.get_href}"><vte:value select="{user.get_name}" /></a>
		</li>
	</vte:foreach>
</ul>