<ul>
	<vte:foreach item="file" from="{file_list}">
		<li>
			<vte:value select="{file.get_basename}" />
		</li>
	</vte:foreach>
</ul>