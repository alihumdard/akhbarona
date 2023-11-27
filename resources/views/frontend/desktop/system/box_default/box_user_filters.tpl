<vte:if test="{user_filters_list}">
	<ul>
		<vte:foreach item = "filter" from = "{user_filters_list}">
			<vte:if test="{filter.name} != ''">
				<li>
					<span><vte:value select="{filter.get_name}" /></span>
				</li>
			</vte:if>
		</vte:foreach>
	</ul>
</vte:if>