<vte:template>
	<vte:header type="script" href="{VIVVO_URL}js/framework/effects.js" />
	<vte:header type="css" href="{VIVVO_THEME}css/navigation.css" />
	<div id="mainNav">
		<vte:box module="box_sections">
			<vte:params>
				<vte:param name="id" value="0" />
			</vte:params>
			<vte:template>
            	<div class="show_all"><a href="javascript:;" onclick="Effect.toggle('navbox', 'slide'); $(this).toggleClassName('collapse'); return false;">إظهار الكل</a></div>
				<ul class="adxm menu">
					<vte:foreach item = "category" from = "{categories}">
                        <vte:if test="{category.view_subcat}">
                            <li class="section_{category.get_id}">
                                <a href="{category.get_href}">
                                    <span><vte:value select="{category.category_name}" /></span>
                                </a>
                            </li>
                        </vte:if>
					</vte:foreach>
				</ul>
			</vte:template>
		</vte:box>
	</div>

    <div id="navbox" style="display:none;">
        <vte:box module="box_sections">
            <vte:params>
                <vte:param name="id" value="0" />
            </vte:params>
            <vte:template>
                <div class="navbox_holder">
                    <vte:for from="{categories}" step="2" key="category_index">
                        <div class="navbox_column">
                            <vte:foreach item = "category" from = "{categories}" loop="2" start="{category_index}" key="index">
                                <vte:if test="{category.view_subcat}">
                                    <ul class="main_list">
                                        <li>
                                            <a href="{category.get_href}">
                                                <strong><vte:value select="{category.category_name}" /></strong>
                                            </a>
                                            <vte:if test="{category.subcategories}">
                                                <vte:box module="box_sections">
                                                    <vte:params>
                                                        <vte:param name="id" value="{category.id}" />
                                                        <vte:param name="prefix" value="" />
                                                    </vte:params>
                                                    <vte:template>
                                                        <vte:if test="{categories|count} &gt; 0">
                                                            <vte:variable name="buffer">
                                                                <ul class="sub_list">
                                                                    <vte:foreach item = "category" from = "{categories}">
                                                                        <vte:if test="{category.view_subcat}">
                                                                            <li>
                                                                                <a href="{category.get_href}">
                                                                                    <vte:value select="{prefix}" />
                                                                                    <vte:value select="{category.category_name}" />
                                                                                </a>
                                                                                <vte:if test="{category.subcategories}">
                                                                                    <vte:load module="box_sections" id="{category.id}" template_string="{template_string}" />
                                                                                </vte:if>
                                                                            </li>
                                                                        </vte:if>
                                                                    </vte:foreach>
                                                                </ul>
                                                            </vte:variable>
                                                            <vte:value select="{buffer|validul}" />
                                                        </vte:if>
                                                    </vte:template>
                                                </vte:box>
                                            </vte:if>
                                        </li>
                                    </ul>
                                </vte:if>
                            </vte:foreach>
                        </div>
                    </vte:for>
                 </div>
             </vte:template>
        </vte:box>
    </div>
</vte:template>