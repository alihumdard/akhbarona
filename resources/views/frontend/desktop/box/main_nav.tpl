<vte:if test="{VIVVO_MODULES_DHTML_SECTIONS}">
	<vte:header type="css" href="{VIVVO_THEME}css/main_nav.css" />
	<vte:header type="script" href="{VIVVO_URL}js/protofish-min.js" />
	<div id="mainNav">
		<vte:box module="box_sections">
			<vte:params>
				<vte:param name="id" value="{VIVVO_ROOT_CATEGORY}" />
			</vte:params>
			<vte:template>
				<ul id="menu_main" class="menu">
                	<vte:variable name="category_count" value="{categories|count}" />
					<vte:foreach item="category" from="{categories}" key="a">
						<vte:if test="{category.view_subcat}">
							<li>
                            	<vte:attribute name="class">
                                    <vte:if test="{a} = {category_count}"> last </vte:if>
                                    <vte:if test="{category.is_child_selected}"> selected </vte:if>

                                </vte:attribute>
								<a>
                                	<vte:attribute name="class">
                                        <vte:if test="{category.subcategories}"> sub </vte:if>
                                    </vte:attribute>
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
                                                <vte:variable name="category_count" value="{categories|count}" />
                                                <vte:foreach item="category" from="{categories}" key="b">
                                                    <vte:if test="{category.view_subcat}">
                                                        <li>
                                                        	<vte:attribute name="class">
                                                                <vte:if test="{b} = {category_count}"> last </vte:if>
                                                                <vte:if test="{category.is_child_selected}"> selected </vte:if>
                                                            </vte:attribute>
                                                            <a>
                                                            	<vte:attribute name="class">
                                                                    <vte:if test="{category.subcategories}"> sub </vte:if>
                                                                </vte:attribute>
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
                <script type="text/javascript">
					Event.observe(window, 'load', function() {
						new ProtoFish('menu_main', '200', 'hover', false, true, true);
					});
                    loadAjax('/ajax.php',resultAjax);
                </script>
			</vte:template>
		</vte:box>
	</div>
</vte:if>
