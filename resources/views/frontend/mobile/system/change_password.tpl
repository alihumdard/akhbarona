<div id="register">
	<h1><vte:value select="{LNG_SIGN_UP}" /></h1>
	<form id="register_form" name="register_form" action="{VIVVO_PROXY_URL}login.html" method="post" >
		<input type="hidden" name="SECURITY_TOKEN" value="{VIVVO_SECURITY_TOKEN}" />
		<input type="hidden" name="action" value="login" />
		<input type="hidden" name="cmd" value="changePassword" />
		<input type="hidden" name="USER_key" value="{key}" />
		<div class="form_line">
			<label><vte:value select="{LNG_USER_PASSWORD}" />:</label>
			<div class="formElement">
				<input type="password" class="text" name="USER_password" value="" style="width: 216px;" />
			</div>
		</div>
		<div class="form_line">
			<label><vte:value select="{LNG_CONFIRM_PASSWORD}" />:</label>
			<div class="formElement">
				<input type="password" class="text" name="USER_retype_password" value="" style="width: 216px;" />
			</div>
		</div>
		<div class="form_line">
			<label> </label>
			<div class="formElement submit">
				<input type="submit" class="submit_button" value="{LNG_SUBMIT_BUTTON}" />
			</div>
		</div>
	</form>
</div>
