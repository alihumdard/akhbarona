<vte:if test="{VIVVO_MODULES_USERS}">
	<vte:if test="{VIVVO_MODULES_TAGS}">
		<vte:box module="box_tags">
			<vte:params>
				<vte:param name="search_limit" value="20" />
				<vte:param name="cache" value="1" />
			</vte:params>
			<vte:template>
				<vte:template>
					<vte:if test="{tag_list}">
						<div id="box_tags" class="box">
							<div class="box_title_holder"><div class="box_title"><vte:value select="{LNG_POPULAR_TAGS}" /></div></div>
							<div class="box_body">
								<div class="box_content">
									<vte:foreach item = "tag" from = "{tag_list}">
										<vte:if test="{tag.name} != ''">
											<a style="font-size:{tag.get_fontsize}px;" href="{tag.get_href}"><vte:value select="{tag.name}" /></a>
										</vte:if>
									</vte:foreach>
								</div>
							</div>
						</div>
					</vte:if>
				</vte:template>
			</vte:template>
		</vte:box>
	</vte:if>
</vte:if>