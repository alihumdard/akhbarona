<vte:box module="who_is_online">
	<vte:params>
		<vte:param name="minutes" value="5" />
	</vte:params>
	<vte:template>
		<div class="box">
			<div class="box_title_holder"><div class="box_title"><vte:value select = "{LNG_PLUGIN_WHO_IS_ONLINE_BOX_TITLE}" />:  <vte:value select="{num_all}" /></div></div>
			<div class="box_body">
				<div class="box_content">
					<div><vte:value select = "{LNG_PLUGIN_WHO_IS_ONLINE_GUESTS}" />: <vte:value select="{num_guests}" /></div>
					<div><vte:value select = "{LNG_PLUGIN_WHO_IS_ONLINE_USERS}" />: <vte:value select="{num_users}" /></div>
					<vte:if test="{num_users} &gt; 0">
						<div>
							<vte:value select = "{LNG_PLUGIN_WHO_IS_ONLINE_USERS_ONLINE}" />: 
							<strong>
							<vte:foreach item = "user" key="index" from = "{users}" start="1" loop="20">
								<vte:if test="{user.get_href}">
									<a href="{user.get_href}"><vte:value select="{user.get_username}" /></a><vte:if test="{index} &lt; {num_users}">, </vte:if>
								<vte:else>
									<vte:value select="{user.get_username}" /><vte:if test="{index} &lt; {num_users}">, </vte:if>
								</vte:else>
								</vte:if>
							</vte:foreach>
							</strong>
						</div>
					</vte:if>
				</div>
			</div>
		</div>
	</vte:template>
</vte:box>