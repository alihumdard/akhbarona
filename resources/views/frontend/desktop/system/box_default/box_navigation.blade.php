<div class="box">
	<div class="box_title_holder"><div class="box_title"><vte:value select="{navigation.title}" /></div></div>
	<div class="box_body">
		<div class="box_content">
			<vte:template recursive="1">
				<ul>
					<vte:foreach item="node" from="{navigation.subnodes}">
						<li>
							<a href="{node.href}">
								<vte:value select="{node.title}" />
							</a>
							<vte:if test="{node.subnodes}">
								<vte:template template_string="{template_string}" navigation="{node}" />
							</vte:if>
						</li>
					</vte:foreach>
				</ul>
			</vte:template>
		</div>
	</div>
</div>