<vte:template>
	<vte:header type="script" file="" />
	<h1 class="page_title"><vte:value select="{LNG_EDIT_PERSONAL_INFORMATION}" /></h1>
	<div class="dump">
		<vte:attribute name="style">
			<vte:if test="!{DUMP_MESSAGES}">display:none;</vte:if>
		</vte:attribute>
		<vte:foreach item = "message" from = "{DUMP_MESSAGES}">
			<span class="{message.type}"><vte:value select="{message.get_message}" />
				<vte:if test="{message.get_error_code} != 0">
					(<vte:value select="{message.get_error_code}" />)
				</vte:if>
				<vte:if test="{message.additional_info} != ''">
					: <vte:value select="{message.additional_info}" />
				</vte:if>
			</span>
		</vte:foreach>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="SECURITY_TOKEN" value ="{VIVVO_SECURITY_TOKEN}" />
		<input type="hidden" name="action" value ="user" />
		<input type="hidden" name="cmd" value ="edit" />
		<input type="hidden" name="USER_id" value ="{CURRENT_USER.get_id}" />
		<div id="user_form">
			<div class="form_line">
				<label><vte:value select="{LNG_USER_FIRST_NAME}" />:</label>
				<div class="formElement">
					<input type="text" class="text default_fields" name="USER_first_name" value ="{CURRENT_USER.first_name}" />
				</div>
			</div>
			<div class="form_line">
				<label><vte:value select="{LNG_USER_LAST_NAME}" />:</label>
				<div class="formElement">
					<input type="text" class="text default_fields" name="USER_last_name" value ="{CURRENT_USER.last_name}" />
				</div>
			</div>
			<div class="form_line">
				<label><vte:value select="{LNG_USER_USERNAME}" />:</label>
				<div class="formElement">
					<span><vte:value select="{CURRENT_USER.username}" /></span>
				</div>
			</div>
			<div class="form_line">
				<label><vte:value select="{LNG_USER_PASSWORD}" />:</label>
				<div class="formElement">
					<input type="password" class="text default_fields" name="USER_password" value ="" />
				</div>
			</div>
			<div class="form_line">
				<label><vte:value select="{LNG_CONFIRM_PASSWORD}" />:</label>
				<div class="formElement">
					<input type="password" class="text default_fields" name="USER_retype_password" value ="" />
				</div>
			</div>
			<div class="form_line">
				<label><vte:value select="{LNG_USER_EMAIL}" />:</label>
				<div class="formElement">
					<input type="text" class="text default_fields" name="USER_email_address" value ="{CURRENT_USER.email_address}" />
				</div>
			</div>
			<div class="form_line">
				<label><vte:value select="{LNG_USER_TEXT}" />:</label>
				<div class="formElement">
					<textarea class="default_fields" name="USER_bio"><vte:value select="{CURRENT_USER.bio}" /></textarea>
				</div>
			</div>
			<div class="form_line">
				<label><vte:value select="{LNG_USER_WWW}" />:</label>
				<div class="formElement">
					https:// <input type="text" class="text default_fields" name="USER_www" value ="{CURRENT_USER.www}" style="width:218px;" />
				</div>
			</div>
			<div class="form_line">
				<label> </label>
				<div class="formElement">
					<input type="submit" class="button" value ="{LNG_SAVE}" />
				</div>
			</div>
		</div>
	</form>
</vte:template>
