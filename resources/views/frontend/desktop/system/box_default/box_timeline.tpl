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
</vte:foreach>>