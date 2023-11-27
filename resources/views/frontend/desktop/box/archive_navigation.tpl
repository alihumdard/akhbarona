<div id="box_archive_navigation" class="box">
	<div class="box_title_holder"><div class="box_title"><vte:value select="{LNG_ARCHIVE_NAVIGATE}" /></div></div>
	<div class="box_body" style="overflow:hidden;width:100%;">
		<vte:box module="box_timeline">
			<vte:params>
				<vte:param name="width" value="550" />
				<vte:param name="max_image_height" value="50" />
			</vte:params>
			<vte:template>
				<vte:foreach from="{count_list}" item="counter">
					<div style="float:left;width:{width}px;">
						<img src="{VIVVO_THEME_BANGTD}img/poll_bar.gif" style="height:{counter[count]}px;width:{width}px;" /><br />
						<vte:if test="{counter[url]}">
							<a href="{counter[url]}"><vte:value select="{counter[label]}" /></a>
							<vte:else>
								<vte:value select="{counter[label]}" />
							</vte:else>
						</vte:if>
					</div>
				</vte:foreach>
			</vte:template>
		</vte:box>
	</div>
</div>