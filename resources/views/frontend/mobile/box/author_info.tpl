<vte:if test="{CURRENT_AUTHOR}">
	<div id="box_users" class="box">
		<h3><vte:value select="{LNG_AUTHOR_INFO}" /></h3>
        <vte:if test="{CURRENT_AUTHOR.picture}">
            <div class="image"><img src="{CURRENT_AUTHOR.get_picture_href}" alt="{CURRENT_AUTHOR.get_name}" /></div>
        </vte:if>
        <vte:if test="{CURRENT_AUTHOR.www}">
            <a href="https://{CURRENT_AUTHOR.www}"><vte:value select="{CURRENT_AUTHOR.get_name}" /></a>
            <vte:else>
                <vte:value select="{CURRENT_AUTHOR.get_name}" />
            </vte:else>
        </vte:if>
        <vte:value select="{CURRENT_AUTHOR.get_bio}" />
	</div>
</vte:if>