<vte:if test="{VIVVO_MODULES_USERS}">
	<script type="text/javascript" src="js/login.js"> </script>
	<script type="text/javascript" src="js/lang.php"> </script>
	<div id="box_login" class="box box_white">
		<h3 class="box_title title_white"><vte:value select="{LNG_USER_LOGIN}" /></h3>
        <vte:if test="!{CURRENT_USER}">
            <vte:if test="!{REGISTRATION}">
                <div id="login_dump">
                    <vte:foreach item = "message" from = "{DUMP_MESSAGES}">
                        <span class="{message.type}"><vte:value select="{message.get_message}" />
                            <vte:if test="{message.additional_info} != ''">
                                : <vte:value select="{message.additional_info}" />
                            </vte:if>
                        </span>
                    </vte:foreach>
                </div>
            </vte:if>
            <div id="login_form_holder">
                <script language="JavaScript" type="text/JavaScript">
                    function login(){
                        emailParam = $('login_form').serialize(true);
                        emailParam.template_output = 'box/login';

                        new Ajax.Updater('login_dump', '<vte:value select="{VIVVO_URL}" />index.php', {
                            parameters: emailParam,
                            evalScripts: true,
                            insertion: Insertion.Before,
                            onComplete: function () {
                            }
                        });
                        return false;
                    }
                </script>
                <form id="login_form" action="" method="post">
                    <input type="hidden" name="SECURITY_TOKEN" value ="{VIVVO_SECURITY_TOKEN}" />
                    <input type="hidden" name="action" value="login" />
                    <input type="hidden" name="cmd" value="login" />
                    <div class="form_line">
                        <label><vte:value select="{LNG_USER_USERNAME}" />:</label>
                        <div class="formElement">
                            <input class="text default_fields" type="text" name="LOGIN_username" value="" />
                        </div>
                    </div>
                    <div class="form_line">
                        <label><vte:value select="{LNG_USER_PASSWORD}" />:</label>
                        <div class="formElement">
                            <input class="text default_fields" type="password" name="LOGIN_password" value="" />
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
                            <a href="{VIVVO_PROXY_URL}login.html"><vte:value select="{LNG_SIGN_UP}" /></a> <input type="submit" class="button" name="login" value="{LNG_LOG_IN}" />
                        </div>
                    </div>
                    <div class="fp_link"><a href="{CURRENT_URL}#" onclick="$('login_form_holder').hide();$('forgot_form_holder').show();"><vte:value select="{LNG_FORGOT_YOUR_PASSWORD}" /></a></div>
                </form>
           </div>
            <div id="forgot_form_holder" style="display:none;">
                <div class="fp_info"><vte:value select="{LNG_INFO_FORGOT_PASSWORD_INFO}" /></div>
                <form action="index.php" id="forgot_password_form" method="post" onsubmit="return false;">
                    <input type="hidden" name="SECURITY_TOKEN" value ="{VIVVO_SECURITY_TOKEN}" />
                    <input type="hidden" name="login" value="1" />
                    <input type="hidden" name="action" value="login" />
                    <input type="hidden" name="cmd" value="forgotMail" />
                    <input type="hidden" name="template_output" value="box/dump" />
                    <div class="form_line">
                        <label><vte:value select="{LNG_USER_USERNAME}" />:</label>
                        <div class="formElement">
                            <input class="text default_fields" type="text" name="LOGIN_username" value="" />
                        </div>
                    </div>
                    <div class="form_line">
                        <label><vte:value select="{LNG_USER_EMAIL}" />:</label>
                        <div class="formElement">
                            <input class="text default_fields" type="text" id="LOGIN_email" name="LOGIN_email" value="" />
                        </div>
                    </div>
                    <div class="form_line">
                        <label> </label>
                        <div class="formElement submit">
                            <input type="submit" class="button" name="login" value="{LNG_SUBMIT_BUTTON}" />
                        </div>
                    </div>
                    <div class="fp_link">
                        <a href="#" onclick="$('login_form_holder').show();$('forgot_form_holder').hide();"><vte:value select="{LNG_RETURN_TO_LOGIN}" /></a>
                    </div>
                </form>
            </div>
            <vte:else>
            	<div class="logged_in">
                    <vte:value select="{CURRENT_USER.get_name}" /> |
                    <strong><a href="{VIVVO_URL}index.php?action=login&amp;cmd=logout"><vte:value select="{LNG_USER_LOGOUT}" /></a></strong>
                </div>
                <div class="fp_link"><a href="{VIVVO_PROXY_URL}usercp.html"><vte:value select="{LNG_EDIT_PERSONAL_INFORMATION}" /></a></div>
            </vte:else>
        </vte:if>
	</div>
</vte:if>