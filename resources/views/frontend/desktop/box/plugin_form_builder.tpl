<vte:template>
	<vte:if test="{DUMP_MESSAGES}">
		<vte:foreach item = "message" from = "{DUMP_MESSAGES}">
			<vte:value select="{message.get_message}" />
		</vte:foreach>
	</vte:if>
	<vte:if test="{message_url}">
        <script type="text/javascript">
            var redirect =  function(){
                window.location = '<vte:value select="{message_url}" />';
            }
            setTimeout ( redirect, 3000 );
        </script>
    </vte:if>
</vte:template>