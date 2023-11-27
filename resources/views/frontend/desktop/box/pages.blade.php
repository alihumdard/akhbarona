<vte:box module="box_pages">
	<vte:params>
		<vte:param name="cache" value="1" />
	</vte:params>
	<vte:template>
		<div class="box_pages">
			<ul>
				<vte:foreach item="page" from="{page_list}">
                	<vte:if test="!{page.hide}">
						<li>
                        	<vte:if test="{page.redirect}">
                                <a href="{page.redirect}"><vte:value select="{page.title}" /></a>
                                <vte:else>
                                	<a href="{page.get_href}"><vte:value select="{page.title}" /></a>
                                </vte:else>
                            </vte:if>
                        </li>
                    </vte:if>
				</vte:foreach>
			</ul>
		</div>
	</vte:template>
</vte:box>