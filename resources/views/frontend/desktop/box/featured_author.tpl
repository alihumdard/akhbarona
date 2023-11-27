<vte:if test="{VIVVO_MODULES_FEATURED_AUTHOR}">
	<vte:box module="box_users">
		<vte:params>
			<vte:param name="search_sort_by" value="random" />
			<vte:param name="search_limit" value="1" />
			<vte:param name="search_user_type" value="{VIVVO_MODULES_FEATURED_AUTHOR_GROUPS}" />
		</vte:params>
		<vte:template>
			<div id="box_users" class="box box_white">
                <h3 class="box_title title_white"><vte:value select="{LNG_FEATURED_AUTHOR}" /></h3>
                <vte:foreach item = "user" from = "{user_list}">
                    <vte:if test="{user.picture}">
                        <img src="{user.get_picture_href|'summary_medium'}" alt="{user.get_name}" />
                    </vte:if>
                    <h4><a href="{user.get_href}"><vte:value select="{user.get_name}" /></a></h4>
                    <vte:value select="{user.get_bio}" />
                    <div class="clearer"> </div>
                    <vte:box module="box_article_list">
                        <vte:params>
                            <vte:param name="cache" value="1" />
                            <vte:param name="search_sort_by" value="created" />
                             <vte:param name="search_user_id" value="{user.get_id}" />
                            <vte:param name="search_limit" value="3" />
                        </vte:params>
                        <vte:template>
                            <ul>
                                <vte:foreach item = "article" from = "{article_list}">
                                    <li>
                                        <a href="{article.get_href}">
                                            <vte:value select="{article.get_title}" />
                                        </a>
                                    </li>
                                </vte:foreach>
                            </ul>
                        </vte:template>
                    </vte:box>
                </vte:foreach>
                <div class="clearer"> </div>
            </div>
		</vte:template>
	</vte:box>
</vte:if>