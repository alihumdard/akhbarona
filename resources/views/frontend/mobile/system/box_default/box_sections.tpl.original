<ul>
	<vte:foreach item = "category" from = "{categories}">
		<vte:if test="{category.view_subcat}">
			<li>
				<a href="{category.get_href}">
					<vte:value select="{category.category_name}" />
				</a>
				<vte:if test="{category.subcategories}">
					<vte:box module="box_sections">
						<vte:params>
							<vte:param name="id" value="{category.id}" />
							<vte:param name="prefix" value="" />
						</vte:params>
						<vte:template>	
							<ul>
								<vte:foreach item = "category" from = "{categories}">
									<vte:if test="{category.view_subcat}">
										<li>
											<a href="{category.get_href}">
												&#187;
												<vte:value select="{prefix}" />
												<vte:value select="{category.category_name}" />
											</a>
											<vte:if test="{category.subcategories}">
												<vte:load module="box_sections" id="{category.id}" template_string="{template_string}" prefix="-{prefix}" />
											</vte:if>
										</li>
									</vte:if>
								</vte:foreach>
							</ul>
						</vte:template>
					</vte:box>
				</vte:if>
			</li>
		</vte:if>
	</vte:foreach>
</ul>