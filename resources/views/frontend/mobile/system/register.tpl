<div id="register">
	<vte:if test="!{CURRENT_USER}">
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
		<vte:if test="!{REGISTRATION}">
			<div id="box_login" class="box">
				<h1><vte:value select="{LNG_USER_LOGIN}" /></h1>
				<div class="box_body">
					<vte:if test="!{CURRENT_USER}">
						<form action="{VIVVO_PROXY_URL}login.html" method="post">
							<input type="hidden" name="SECURITY_TOKEN" value ="{VIVVO_SECURITY_TOKEN}" />
							<input type="hidden" name="action" value="login" />
							<input type="hidden" name="cmd" value="login" />
							<div class="form_line">
								<label><vte:value select="{LNG_USER_USERNAME}" />:</label>
								<div class="formElement">
									<input class="text" type="text" name="LOGIN_username" value="" style=" width: 216px;" />
								</div>
							</div>
							<div class="form_line">
								<label><vte:value select="{LNG_USER_PASSWORD}" />:</label>
								<div class="formElement">
									<input class="text" type="password" name="LOGIN_password" value="" style=" width: 216px;" />
								</div>
							</div>
							<div class="form_line">
								<label> </label>
								<div class="formElement">
									<label><input type="checkbox" name="LOGIN_remember" value="1" /> <vte:value select="{LNG_USER_REMEMBER_ME}" /></label>
								</div>
							</div>
							<div class="form_line">
								<label> </label>
								<div class="formElement submit">
									<input type="submit" class="submit_button" name="login" value="{LNG_LOG_IN}" />
								</div>
							</div>
						</form>
						<vte:else>
							<vte:value select="{CURRENT_USER.get_name}" />
							<strong><a href="{VIVVO_URL}index.php?action=login&amp;cmd=logout"><vte:value select="{LNG_USER_LOGOUT}" /></a></strong>
						</vte:else>
					</vte:if>
				</div>
			</div>
		</vte:if>
		<vte:else>
			<vte:value select="{LNG_ALLERADY_LOGGED_IN}" />
		</vte:else>
	</vte:if>
</div>
