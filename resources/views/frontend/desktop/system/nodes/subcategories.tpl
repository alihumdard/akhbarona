<vte:if test="{CURRENT_CATEGORY}">
	<vte:if test="{CURRENT_CATEGORY.view_subcat}">
		<vte:box module="box_sections">
			<vte:params>
				<vte:param name="id" value="{CURRENT_CATEGORY.get_id}" />
			</vte:params>
			<vte:template>
				<vte:foreach item="category" from="{categories}">
					<li>
						<a href="{category.get_href}">
							<vte:value select="{category.get_category_name}" />
						</a>
						<vte:if test="{node.get_meta[include_subcategories]}">
							<vte:if test="{category.view_subcat}">
								<vte:if test="{category.subcategories}">
									<ul>
										<vte:load module="box_sections" id="{category.get_id}" template_string="{template_string}" />
									</ul>
								</vte:if>
							</vte:if>
						</vte:if>
					</li>
				</vte:foreach>
			</vte:template>
		</vte:box>
	</vte:if>
</vte:if>
