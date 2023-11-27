<ul>
	<vte:foreach item="feed" from="{feed_list}">
		<li>
			<a href="{feed.get_permalink}"><vte:value select="{feed.get_title}" /></a>
		</li>
	</vte:foreach>
</ul>