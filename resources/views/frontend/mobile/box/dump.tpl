<div class="dump">
	<vte:attribute name="style">
		<vte:if test="!{DUMP_MESSAGES}">display:none;</vte:if>
	</vte:attribute>
	<vte:foreach item = "message" from = "{DUMP_MESSAGES}">
		<span class="{message.type}"><vte:value select="{message.get_message}" />
			<vte:if test="{message.additional_info} != ''">
				: <vte:value select="{message.additional_info}" />
			</vte:if>
		</span>
	</vte:foreach>
</div>
