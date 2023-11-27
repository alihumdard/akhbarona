<vte:if test="{VIVVO_MODULES_USERS}">
	<div id="box_login" class="box">
		<div class="box_title_holder"><div class="box_title"><vte:value select="{LNG_USER_LOGIN}" /></div></div>
		<div class="box_body">
			<div class="box_content">
				<vte:if test="!{CURRENT_USER}">
					<form action="" method="post">
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
								<a href="{VIVVO_PROXY_URL}login.html"><vte:value select="{LNG_SIGN_UP}" /></a> <input type="submit" class="submit_button" name="login" value="{LNG_LOG_IN}" />
							</div>
						</div>
					</form>
					<vte:else>
						<vte:value select="{CURRENT_USER.get_name}" /> |
						<strong><a href="{VIVVO_URL}index.php?action=login&amp;cmd=logout"><vte:value select="{LNG_USER_LOGOUT}" /></a></strong>
					</vte:else>
				</vte:if>
			</div>
		</div>
	</div>
</vte:if>