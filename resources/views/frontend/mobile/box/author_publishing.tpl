<div id="box_archive_navigation" class="box">
	<h3><vte:value select="{LNG_ARCHIVE_NAVIGATE}" /></h3>
	<div class="box_body" style="overflow:hidden;width:100%;">
		<div class="box_content">
			<vte:box module="box_author_timeline">
				<vte:params>
					<vte:param name="search_author_id" value="{CURRENT_AUTHOR.get_id}" />
				</vte:params>
				<vte:template>
					<vte:foreach from="{count_list}" item="year">
						<div>
							<h3><vte:value select="{year[label]}" /></h3>
							<ul>
							<vte:foreach from="{year[data]}" item="month">
								<li><a href="{month[url]}"><vte:value select="{month[label]}" /> (<vte:value select="{month[count]}" />)</a></li>
							</vte:foreach>
							</ul>
						</div>
					</vte:foreach>
				</vte:template>
			</vte:box>
		</div>
	</div>
</div>