<table width="100%" cellpadding="0" cellspacing="1">
	<caption>
		<vte:if test="{month_url}">
			<a href="{month_url}"><vte:value select="{month}" />, <vte:value select="{year}" /></a>
			<vte:else>
				<vte:value select="{month}" />, <vte:value select="{year}" />
			</vte:else>
		</vte:if>
	</caption>
	<tr>
		<td><strong><vte:value select="{LNG_SU}" /></strong></td>
		<td><strong><vte:value select="{LNG_MO}" /></strong></td>
		<td><strong><vte:value select="{LNG_TU}" /></strong></td>
		<td><strong><vte:value select="{LNG_WE}" /></strong></td>
		<td><strong><vte:value select="{LNG_TH}" /></strong></td>
		<td><strong><vte:value select="{LNG_FR}" /></strong></td>
		<td><strong><vte:value select="{LNG_SA}" /></strong></td>
	</tr>
	<vte:for from="{count_list}" step="7" key="week_index">
		<tr>
			<vte:foreach from="{count_list}" item="counter" start="{week_index}" loop="7">
				<td>
					<vte:if test="{counter[url]}">
						<a href="{counter[url]}" style="color:#F00;"><vte:value select="{counter[label]}" /></a>
						<vte:else>
							<vte:value select="{counter[label]}" />
						</vte:else>
					</vte:if>
				</td>
			</vte:foreach>
		</tr>
	</vte:for>
</table>