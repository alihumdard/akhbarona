<vte:if test="{VIVVO_MODULES_SECTIONS}">
	<div id="box_sections" class="box box_gray">
		<h3 class="box_title title_gray"><vte:value select="{LNG_SECTIONS}" /></h3>
        <vte:box module="box_sections">
            <vte:params>
                <vte:param name="id" value="0" />
            </vte:params>
            <vte:template>
                <ul>
                	<vte:variable name="category_count" value="{categories|count}" />
                    <vte:foreach item="category" from="{categories}" key="a">
                        <vte:if test="{category.view_subcat}">
                            <li>
                            	<vte:attribute name="class">
                                    <vte:if test="{a} = {category_count}"> last </vte:if>
                                    <vte:if test="{category.is_child_selected}"> selected </vte:if>
                                </vte:attribute>
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
                                            <vte:param name="prefix" value="" />
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
                                                                <vte:attribute name="href">
                                                                    <vte:if test="{category.redirect}">
                                                                        <vte:value select="{category.redirect}" />
                                                                        <vte:else>
                                                                            <vte:value select="{category.get_href}" />
                                                                        </vte:else>
                                                                    </vte:if>
                                                                </vte:attribute>
                                                                &#8250;<vte:value select="{prefix}" />
                                                                <vte:value select="{category.category_name}" />
                                                            </a>
                                                            <vte:if test="{category.subcategories}">
                                                                <vte:load module="box_sections" id="{category.id}" template_string="{template_string}" prefix="&#8250;{prefix}" />
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