<vte:if test="{VIVVO_MODULES_DHTML_SECTIONS}">
	<vte:header type="css" href="{VIVVO_THEME}css/dhtml_menu.css" />
	<vte:header type="script" href="{VIVVO_STATIC_URL}js/ADxMenu.js" />
	<div id="mainNav">
		<vte:box module="box_sections">
			<vte:params>
				<vte:param name="id" value="{VIVVO_ROOT_CATEGORY}" />
			</vte:params>
			<vte:template>
				<ul class="adxm menu">
					<vte:foreach item="category" from="{categories}">
						<vte:if test="{category.view_subcat}">
							<li>
								<a>
									<vte:attribute name="href">
										<vte:if test="{category.redirect}">
											<vte:value select="{category.redirect}" />
											<vte:else>
												<vte:value select="{category.get_href}" />
											</vte:else>
										</vte:if>
									</vte:attribute>
									<vte:value select="{category.category_name}" />
								</a>
								<vte:if test="{category.subcategories}">
										<vte:box module="box_sections">
											<vte:params>
												<vte:param name="id" value="{category.id}" />
											</vte:params>
											<vte:template>
												<ul>
													<vte:foreach item="category" from="{categories}">
														<vte:if test="{category.view_subcat}">
															<li>
																<a>
																	<vte:attribute name="href">
																		<vte:if test="{category.redirect}">
																			<vte:value select="{category.redirect}" />
																			<vte:else>
																				<vte:value select="{category.get_href}" />
																			</vte:else>
																		</vte:if>
																	</vte:attribute>
																	<vte:value select="{category.category_name}" />
																</a>
																<vte:if test="{category.subcategories}">
																	<vte:load module="box_sections" id="{category.id}" template_string="{template_string}" />
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
			</vte:template>
		</vte:box>
	</div>
</vte:if>