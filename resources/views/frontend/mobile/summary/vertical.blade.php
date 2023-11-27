<p><a href="{VIVVO_URL}{article.get_href}"><vte:if test="{article.image}"><img class="lazyload" data-src="{VIVVO_URL}thumbnail.php?file={article.image}&amp;size={image_size}" alt="image" /></vte:if></a> <span>

  	<a href="{VIVVO_URL}{article.get_href}"><vte:value select="{article.get_title}" /></a>

  	</span> </p>
  	<p> <span>
  		<vte:value select="{article.get_summary}" />
  		</span>
  	</p>
  	<p>	
  	<vte:if test="!{article.get_link}">
		<vte:if test="{article.body}">
			<a href="{VIVVO_URL}{article.get_href}"> <vte:value select="{LNG_FULL_STORY}" /></a>
		</vte:if>
		<vte:else>
			<a class="visit" href="{VIVVO_URL}{article.get_link}"><img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}"/></a>
		</vte:else>
	</vte:if>
	
	</p>