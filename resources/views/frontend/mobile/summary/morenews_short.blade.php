<div class="short">
	<div class="short_holder">
		<h3><a href="{VIVVO_URL}{article.get_href}"><vte:value select="{article.get_title}" /></a></h3>
		<span class="summary">
			<vte:value select="{article.get_summary}" />
		</span>
		<div class="article_link">
			<vte:if test="!{article.get_link}">
				<vte:if test="{article.body}">
					<a href="{VIVVO_URL}{article.get_href}"> (<vte:value select="{LNG_FULL_STORY}" />...)</a>
				</vte:if>
				<vte:else>
					<a class="visit" href="{VIVVO_URL}{article.get_link}"><img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}"/></a>
				</vte:else>
			</vte:if>
		</div>
	</div>
</div>