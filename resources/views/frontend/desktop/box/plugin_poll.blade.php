<vte:template>
	<vte:header type="css" href="{VIVVO_THEME}css/plugin_poll.css" />
	<vte:header type="script" href="{VIVVO_STATIC_URL}plugins/poll/js/poll.js" />
	<vte:box module="box_poll">
		<vte:params>
			<vte:param name="search_pid" value="{search_pid}" />
		</vte:params>
		<vte:template>
			<vte:if test="{poll}">
				<vte:if test="{ajax_output}">
                    <vte:foreach item="answer" from="{answer_list}" key="index">
                        <label>
                            <vte:value select="{answer.answer}" /><br />
                            <img src="{VIVVO_THEME_BANGTD}img/poll_bar.gif" style="width:{answer.get_percent}px;height:15px;" />
                            <vte:value select="{answer.vote}" />
                        </label> 
                    </vte:foreach>
                    <div class="button_holder"><a href="{VIVVO_URL}poll/index.html" class="view_polls"><vte:value select="{LNG_PLUGIN_POLL_VIEW_ALL_POLLS}" /></a></div>
					<vte:else>
						<h3 class="box_title_poll title_poll"><vte:value select="{LNG_PLUGIN_POLL_POLL}" />: <vte:value select="{poll.name}" /></h3>
						<div id="box_poll_{poll.id}" class="box box_white box_poll">
                            <span class="poll_question"><vte:value select="{poll.question}" /></span>
                            <vte:if test="{poll.is_voted}">
                                <vte:if test="{answer_list}">
                                    <vte:foreach item = "answer" from = "{answer_list}" key="index">
                                        <label>
                                            <vte:value select="{answer.answer}" /><br />
                                            <img src="{VIVVO_THEME_BANGTD}img/poll_bar.gif" style="width:{answer.get_percent}px;height:15px;" />
                                            <vte:value select="{answer.vote}" />
                                        </label> 
                                    </vte:foreach>
                                    <div class="button_holder"><a href="{VIVVO_URL}poll/index.html" class="view_polls"><vte:value select="{LNG_PLUGIN_POLL_VIEW_ALL_POLLS}" /></a></div>
                                </vte:if>
                                <vte:else>
                                    <vte:if test="{answer_list}">
                                        <div id="poll_form_holder_{poll.id}">
                                            <form method="post" id="poll_form_{poll.id}" onsubmit="updatePoll({poll.id});return false;">
                                                <input type="hidden" name="action" value="poll" />
                                                <input type="hidden" name="cmd" value="vote" />
                                                <vte:foreach item = "answer" from = "{answer_list}" key="index">
                                                    <label>
                                                        <input type="radio" name="PLUGIN_POLL_answer_id" value="{answer.id}" />
                                                        <vte:value select="{answer.answer}" />
                                                    </label>
                                                </vte:foreach>
                                                <div class="button_holder">
                                                	<a href="{VIVVO_URL}poll/index.html" class="view_polls"><vte:value select="{LNG_PLUGIN_POLL_VIEW_ALL_POLLS}" /></a>
                                                    <input class="button" type="submit" name="submit" value="{LNG_PLUGIN_POLL_VOTE}" />
                                                </div>
                                            </form>
                                        </div>
                                    </vte:if>
                                </vte:else>
                            </vte:if>
						</div>
					</vte:else>
				</vte:if>
			</vte:if>
		</vte:template>
	</vte:box>
</vte:template>