<vte:if test="{VIVVO_MODULES_USERS}">
	<div class="box_body">
		<vte:box module="box_users">
			<vte:params>
				<vte:param name="search_sort_by" value="name" />
				<vte:param name="search_limit" value="200" />
				<vte:param name="search_user_type" value="{VIVVO_MODULES_FEATURED_AUTHOR_GROUPS}" />
			</vte:params>
			<vte:template>
				<vte:foreach from="{user_list}" item="user">
					<div class="short">
						<div class="short_holder">
						<vte:if test="{user.picture}">
							<div class="image">
								<img src="{VIVVO_STATIC_URL}thumbnail.php?file={user.get_picture}&amp;size=summary_large" alt="image" />
							</div>
						</vte:if>
						<h2><a href="{user.get_href}"><vte:value select="{user.get_name}" /></a></h2>
						<span class="summary"><vte:value select="{user.get_bio}" /></span>
						</div>
					</div>
				</vte:foreach>
			</vte:template>
		</vte:box>
	</div>
</vte:if>