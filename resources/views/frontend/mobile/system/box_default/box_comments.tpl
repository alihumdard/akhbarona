<ul>
	<vte:foreach item = "comment" from = "{comment_list}">
		<li>
			<vte:value select="{comment.get_description}" />
		</li>
	</vte:foreach>
</ul>