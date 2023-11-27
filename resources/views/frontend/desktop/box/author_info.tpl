<vte:if test="{CURRENT_AUTHOR}">
	<div id="box_users" class="box box_white">
		<h3 class="box_title title_white"><vte:value select="{LNG_AUTHOR_INFO}" /></h3>
        <vte:if test="{CURRENT_AUTHOR.picture}">
            <img src="{CURRENT_AUTHOR.get_picture_href}" alt="{CURRENT_AUTHOR.get_name}" />
        </vte:if>
        <vte:if test="{CURRENT_AUTHOR.www}">
            <a href="https://{CURRENT_AUTHOR.www}"><vte:value select="{CURRENT_AUTHOR.get_name}" /></a>
            <vte:else>
                <vte:value select="{CURRENT_AUTHOR.get_name}" />
            </vte:else>
        </vte:if>
        <vte:value select="{CURRENT_AUTHOR.get_bio}" />
        <div class="clearer"> </div>
	</div>
</vte:if>