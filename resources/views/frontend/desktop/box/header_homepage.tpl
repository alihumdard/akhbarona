<div id="header">
	<div class="top_bar">
        <div class="mobile">
        	   <vte:load module="box_banners" search_zone_id="10" /> -| 
            <vte:if test="{VIVVO_FRIENDY_URL}">
                <a href="{VIVVO_URL}archive"><vte:value select="{LNG_ARCHIVE}" /></a>
                <vte:else>
                    <a href="{VIVVO_PROXY_URL}archive"><vte:value select="{LNG_ARCHIVE}" /></a>
                </vte:else>
            </vte:if>
        </div>
    </div>
    <div class="header_holder">
        <div class="header_image">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td>
            <a href="{VIVVO_URL}"><img src="{VIVVO_THEME_BANGTD}img/logo.gif" alt="{VIVVO_WEBSITE_TITLE}" title="{VIVVO_WEBSITE_TITLE}" /></a></td>
					<td>&nbsp;<vte:load module="box_banners" search_zone_id="1" /></td>
				</tr>
			</table>
&nbsp;<div class="header_ad">
					<!--dsf-->
			</div>
        </div>
        <div class="header_date">
            <vte:value select="{LNG_LOGO_TITLE}" />
            <div class="data_date">
            </div>
        </div>
    </div>
	<vte:include file="{VIVVO_TEMPLATE_DIR}box/main_nav_homepage.tpl" />
</div>