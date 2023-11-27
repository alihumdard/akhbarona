<vte:box module="box_article_list">
	<vte:params>
		<vte:param name="search_sort_by" value="created" />
		<vte:param name="search_user_id" value="{CURRENT_USER.get_id}" />
		<vte:param name="search_limit" value="10" />
		<vte:param name="pg" value="{pg}" />
	</vte:params>
	<vte:template>
		<vte:header type="script" href="{VIVVO_URL}plugins/submit_story/js/box_my_stories.js" />
		<div id="box_my_stories" class="box box_white">
			<h3 class="box_title title_white"><vte:value select="{LNG_PLUGIN_SUBMIT_STORY_MY_STORIES}" /></h3>
            <ul>
                <vte:foreach item = "article" from = "{article_list}">
                    <li>
                        <a href="{article.get_href}" title="Comments: {article.get_number_of_comments}\nTags: {article.get_number_of_tags}\nViews Total: {article.get_times_read}\nViews Today: {article.get_today_read}\nVotes/Ratings: {article.get_vote_average|2} out of {article.get_vote_num}\nEmailed to a friend: {article.emailed} times">
                            <vte:value select="{article.get_title}" />
                        </a>
                    </li>
                </vte:foreach>
            </ul>
            <vte:box module="box_pagination">
                <vte:params>
                    <vte:param name="list" value="{article_list_object}" />
                    <vte:param name="max_page" value="5" />
                </vte:params>
                <vte:template>
                    <div id="box_pagination">
                        <span class="pagination">	
                            <vte:if test="{previous_page_group} != ''">
                                <span class="page_button" onclick="onPageChange({previous_page_group_number});">&lt;</span>
                            </vte:if>
                                
                            <vte:foreach item = "page" from = "{page_list}">
                                <vte:if test="{current_page} != {page[number]}">
                                    <span class="page_button" onclick="onPageChange({page[number]});"><vte:value select="{page[number]}" /></span>
                                    <vte:else>
                                        <vte:value select="{page[number]}" />
                                    </vte:else>
                                </vte:if>
                            </vte:foreach>
                                
                            <vte:if test="{next_page_group} != ''">
                                <span class="page_button" onclick="onPageChange({next_page_group_number});">&gt;</span>
                            </vte:if>
                        </span>
                        <vte:value select="{LNG_PLUGIN_SUBMIT_STORY_TOTAL}" />: 
                        
                        <span class="pagination_total">
                            <vte:value select="{total_records}" />
                        </span> 
                        
                        | <vte:value select="{LNG_PLUGIN_SUBMIT_STORY_DISPLAYING}" />:
                        
                        <span class="pagination_total">
                            <vte:value select="{displaying}" />
                        </span> 
                    </div>
                </vte:template>
            </vte:box>
		</div>
	</vte:template>
</vte:box>