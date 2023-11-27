<vte:template>
	<vte:if test="{ajax_output}">
		<div id="newsletter_dump">
			<vte:foreach item = "message" from = "{DUMP_MESSAGES}">
				<span class="{message.type}"><vte:value select="{message.get_message}" />
					<vte:if test="{message.additional_info} != ''">
						: <vte:value select="{message.additional_info}" />
					</vte:if>
				</span>
			</vte:foreach>
			<vte:if test="{action}">
				<script language="JavaScript" type="text/JavaScript">
					if ($('newsletter_form')) $('newsletter_form').hide();
				</script>
			</vte:if>
		</div>
		<vte:else>
			<div id="box_newsletter" class="box box_gray">
				<vte:header type="css" href="{VIVVO_THEME}css/plugin_newsletter.css" />
				<h3 class="box_title title_gray"><vte:value select="{LNG_PLUGIN_NEWSLETTER_BOX_NAME}" /></h3>
                <div id="newsletter_form_holder">
                    <vte:if test="!{CURRENT_USER}">
                        <form id="newsletter_form" action="" method="post" onsubmit="updateNewsletter();return false;">
                            <input type="hidden" name="action" value="newsletter" />
                            <input type="hidden" name="cmd" value="subscriberAdd" />
                            <input class="text newsletter_input default_fields" type="text" name="PLUGIN_NEWSLETTER_email" onfocus="this.value=''" onblur="if(!this.value)this.value='{LNG_PLUGIN_NEWSLETTER_YOUR_EMAIL}'" value="{LNG_PLUGIN_NEWSLETTER_YOUR_EMAIL}" />
                            <input type="submit" class="button" name="submit" value="{LNG_PLUGIN_NEWSLETTER_SUBSCRIBE}" />
                        </form>
                        <vte:else>
                            <vte:if test="{CURRENT_USER.subscriber}">
                                <form id="newsletter_form" action="" method="post" onsubmit="updateNewsletter();return false;">
                                    <input type="hidden" name="action" value="newsletter" />
                                    <input type="hidden" name="cmd" value="subscriberUserRemove" />
                                    <input type="submit" class="button" name="submit" value="{LNG_PLUGIN_NEWSLETTER_UNSUBSCRIBE}" />
                                </form>
                                <vte:else>
                                    <form id="newsletter_form" action="" method="post" onsubmit="updateNewsletter();return false;">
                                        <input type="hidden" name="action" value="newsletter" />
                                        <input type="hidden" name="cmd" value="subscriberUserAdd" />
                                        <input type="submit" class="button" name="submit" value="{LNG_PLUGIN_NEWSLETTER_SUBSCRIBE}" />
                                    </form>
                                </vte:else>
                            </vte:if>
                        </vte:else>
                    </vte:if>
                </div>
				<script src="{VIVVO_URL}js/plugin_newsletter.js" type="text/javascript"> </script>
			</div>
		</vte:else>
	</vte:if>
</vte:template>