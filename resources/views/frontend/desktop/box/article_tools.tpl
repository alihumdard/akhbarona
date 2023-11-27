<div id="box_article_tools">
	<div class="box_title_holder"><div class="box_title"> </div></div>
	<div class="box_body">
		<div class="box_content">
			<ul>
				<li>
					<vte:include file="{VIVVO_TEMPLATE_DIR}box/email_to_a_friend.tpl" />
				</li>
				<li>
					<a href="{article.get_print_href}" target="_blank"><img src="{VIVVO_THEME_BANGTD}img/icon_print.png" alt="{LNG_PRINT_VERSION}" /> <vte:value select="{LNG_PRINT_VERSION}" /></a>
				</li>
				<vte:if test="{VIVVO_MODULES_PLAINTEXT}">
					<li>
						<a href="{CURRENT_URL|switch_format:'txt'}"><img src="{VIVVO_THEME_BANGTD}img/icon_text.png" alt="{LNG_PLAIN_TEXT}" /> <vte:value select="{LNG_PLAIN_TEXT}" /></a>
					</li>
				</vte:if>
			</ul>
		</div>
	</div>
</div>