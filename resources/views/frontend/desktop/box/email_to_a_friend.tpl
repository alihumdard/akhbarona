<vte:if test="{VIVVO_EMAIL_ENABLE}">
	<div id="email_to_afriend">
		<vte:if test="{ajax_output}">
			<div id="email_to_a_friend_dump">
				<vte:foreach item = "message" from = "{DUMP_MESSAGES}">
					<span class="{message.type}"><vte:value select="{message.get_message}" />
						<vte:if test="{message.additional_info} != ''">
							: <vte:value select="{message.additional_info}" />
						</vte:if>
					</span>
				</vte:foreach>
				<vte:if test="{action}">
					<script language="JavaScript" type="text/JavaScript">
						$('send_article').hide();
						<vte:if test="{VIVVO_ANALYTICS_TRACKER_ID}">
							_gaq.push(['_trackEvent', 'Article', 'Email', $('email_to_article_id').value, 1]);
						</vte:if>
					</script>
				</vte:if>
			</div>
			<vte:else>
				<a href="javascript:;" onclick="$('send_article').toggle();"><img src="{VIVVO_THEME_BANGTD}img/icon_email.png" alt="{LNG_EMAIL_FRIEND}" /> <vte:value select="{LNG_EMAIL_FRIEND}" /></a>
				<div id="send_article" style="display:none;">
					<script language="JavaScript" type="text/JavaScript">
						function updateEmailToAFriend(){
							if ($('email_to_a_friend_dump')){
								$('email_to_a_friend_dump').remove();
							}

							var emailParam = $('email_to_a_friend_form').serialize(true);
							emailParam.template_output = 'box/email_to_a_friend';
								
							$('send_email').disable();
							
							new Ajax.Updater('email_to_afriend', '<vte:value select="{VIVVO_URL}" />index.php', {
								parameters: emailParam,
								evalScripts: true,
								insertion: Insertion.Before,
								onComplete: function () { 
									$('send_email').enable();
								}
							});
							return false;
						}
					</script>
					<form id="email_to_a_friend_form" action="" method="post" onsubmit="updateEmailToAFriend();return false;">
						<div class="form_line"> 
							<label><vte:value select="{LNG_TO}" />:</label>
							<div class="formElement">
								<input class="text email_article default_fields" type="text" name="ARTICLE_to" />
							</div>
						</div>
						<div class="form_line"> 
							<label><vte:value select="{LNG_BCC}" />:</label>
							<div class="formElement">
								<input class="text email_article default_fields" type="text"  name="ARTICLE_bcc" />
							</div>
						</div>
						<div class="form_line"> 
							<label><vte:value select="{LNG_YOUR_EMAIL_ADDRESS}" />:</label>
							<div class="formElement">
								<input class="text email_article default_fields" type="text"  name="ARTICLE_your_email" />
							</div>
						</div>
						<div class="form_line">
							<label><vte:value select="{LNG_MESSAGE}" />:</label>
							<div class="formElement">
								<textarea class="email_article default_fields" name="ARTICLE_message" rows="5" cols="38" onfocus="this.value='';this.onfocus = null;"> </textarea>
							</div>
						</div>
						<div class="form_line"> 
							<label> </label>
							<div class="formElement submit">
								<input id="send_email" class="button" type="submit" value="{LNG_SENDEMAIL_SUBMIT}" align="middle" />
								<input type="hidden" id="email_to_article_id" name="ARTICLE_id" value="{article.get_id}" />
								<input type="hidden" name="action" value="article" />
								<input type="hidden" name="cmd" value="mail" />
							</div>
						</div>
					</form>
				</div>
			</vte:else>
		</vte:if>
	</div>
</vte:if>