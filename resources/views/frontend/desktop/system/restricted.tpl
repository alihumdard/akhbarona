<vte:template>
	<div id="register">
		<p><vte:value select="{LNG_RESTRICTED_ONLY_REGISTERED}" /></p>
		<vte:if test="!{CURRENT_USER}">
			<div id="box_login" class="box">
				<div class="box_body">
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
								<input type="submit" class="submit_button" name="login" value="{LNG_LOG_IN}" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</vte:if>
	</div>
</vte:template>