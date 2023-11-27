<vte:box module="box_calendar">
    <vte:template>
    	<h3 class="box_title title_white"><vte:value select="{LNG_ARCHIVE_NAVIGATE}" /></h3>
        <table width="100%" cellpadding="0" cellspacing="1">
            <caption>
                <span onclick="updateCallendar({prev_year}, 1);"><img src="{VIVVO_THEME_BANGTD}img/pagination_first.gif" alt="first" /></span>
                <span onclick="updateCallendar({prev_month_year}, {prev_month});"><img src="{VIVVO_THEME_BANGTD}img/pagination_back.gif" alt="first" /></span>
                <vte:if test="{month_url}">
                    <a href="{month_url}"><vte:value select="{month}" />, <vte:value select="{year}" /></a>
                    <vte:else>
                        <vte:value select="{month}" />, <vte:value select="{year}" />
                    </vte:else>
                </vte:if>
                <span onclick="updateCallendar({next_month_year}, {next_month});"><img src="{VIVVO_THEME_BANGTD}img/pagination_next.gif" alt="first" /></span>
                <span onclick="updateCallendar({next_year}, 1);"><img src="{VIVVO_THEME_BANGTD}img/pagination_last.gif" alt="first" /></span>
            </caption>
            <tr>
                <td><strong><vte:value select="{LNG_SU}" /></strong></td>
                <td><strong><vte:value select="{LNG_MO}" /></strong></td>
                <td><strong><vte:value select="{LNG_TU}" /></strong></td>
                <td><strong><vte:value select="{LNG_WE}" /></strong></td>
                <td><strong><vte:value select="{LNG_TH}" /></strong></td>
                <td><strong><vte:value select="{LNG_FR}" /></strong></td>
                <td><strong><vte:value select="{LNG_SA}" /></strong></td>
            </tr>
            <vte:for from="{count_list}" step="7" key="week_index">
                <tr>
                    <vte:foreach from="{count_list}" item="counter" start="{week_index}" loop="7">
                        <td>
                            <vte:if test="{counter[url]}">
                                <a href="{counter[url]}" style="color:#F00;"><vte:value select="{counter[label]}" /></a>
                                <vte:else>
                                    <vte:value select="{counter[label]}" />
                                </vte:else>
                            </vte:if>
                        </td>
                    </vte:foreach>
                </tr>
            </vte:for>
        </table>
        <script type="text/javascript">
			function updateCallendar(year, month){
				calendarParam = {};
				calendarParam.year = year;
				calendarParam.month = month;
				calendarParam.template_output = 'box/archive_calendar';
													
				new Ajax.Updater('box_calendar', '<vte:value select="{VIVVO_URL}" />index.php', {
					parameters: calendarParam,
					evalScripts: true,
					insertion: Insertion.Replace
				});
			}
		</script>
    </vte:template>
</vte:box>