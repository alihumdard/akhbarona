<ul>
	<vte:foreach item = "article" from = "{article_list}">
		<li>
			<a href="{article.get_href}">
				<vte:value select="{VIVVO_URL}{article.get_title}" />
			</a>
		</li>
	</vte:foreach>
</ul>