<div class="video_tabs">

	<ul id="tabs_videos" class="tabs">
        <li><a href="#videos_latest"><vte:value select="{LNG_PLUGIN_VIDEO_BOX_LATEST_VIDEOS}" /></a></li>
		<vte:if test="{VIVVO_MODULES_MOST_POPULAR}">
            <li><a href="#videos_most_popular"><vte:value select="{LNG_MOST_POPULAR}" /></a></li>
        </vte:if>
        <vte:if test="{VIVVO_MODULES_TOP_RATED}">
            <li><a href="#videos_top_rated"><vte:value select="{LNG_TOP_RATED}" /></a></li>
        </vte:if>
        <vte:if test="{VIVVO_MODULES_MOST_COMMENTED}">
            <li><a href="#videos_most_commented"><vte:value select="{LNG_MOST_COMMENTED}" /></a></li>
        </vte:if>
	</ul>
	<vte:if test="!{video_holder_id}">
        <vte:variable name="video_holder_id" value="video_playlist" />
    </vte:if>
    
    <div class="video_lists">
    
    	<vte:box module="box_article_list">
            <vte:params>
                <vte:param name="search_field_video_attachment_neq" value="" />
                <vte:param name="search_field_video_attachment_notnull" value="1" />
                <vte:param name="search_cid" value="{CURRENT_CATEGORY.get_id}" />
                <vte:param name="cache" value="1" />
                <vte:param name="search_sort_by" value="created" />
                <vte:param name="search_limit" value="20" />
            </vte:params>
            <vte:template>
                <div id="videos_latest">                
                    <vte:foreach item = "article" from = "{article_list}" key="latest">
                        <vte:include file="{VIVVO_TEMPLATE_DIR}summary/video_short.tpl" />
                    </vte:foreach>
                </div>
            </vte:template>
        </vte:box>
    
        <vte:box module="box_article_list">
            <vte:params>
                <vte:param name="search_field_video_attachment_neq" value="" />
                <vte:param name="search_field_video_attachment_notnull" value="1" />
                <vte:param name="search_cid" value="{CURRENT_CATEGORY.get_id}" />
                <vte:param name="cache" value="1" />
                <vte:param name="search_sort_by" value="most_popular" />
                <vte:param name="search_limit" value="5" />
            </vte:params>
            <vte:template>
                <div id="videos_most_popular">
                    <vte:foreach item = "article" from = "{article_list}" key="popular">
                        <vte:include file="{VIVVO_TEMPLATE_DIR}summary/video_short.tpl" />
                    </vte:foreach>
                </div>
            </vte:template>
        </vte:box>
        
        <vte:box module="box_article_list">
            <vte:params>
                <vte:param name="search_field_video_attachment_neq" value="" />
                <vte:param name="search_field_video_attachment_notnull" value="1" />
                <vte:param name="search_cid" value="{CURRENT_CATEGORY.get_id}" />
                <vte:param name="cache" value="1" />
                <vte:param name="search_sort_by" value="vote_avg" />
                <vte:param name="search_limit" value="5" />
            </vte:params>
            <vte:template>
                <div id="videos_top_rated">
                    <vte:foreach item = "article" from = "{article_list}" key="rated">
                        <vte:include file="{VIVVO_TEMPLATE_DIR}summary/video_short.tpl" />
                    </vte:foreach>
                </div>
            </vte:template>
        </vte:box>
        
        <vte:box module="box_article_list">
            <vte:params>
                <vte:param name="search_field_video_attachment_neq" value="" />
                <vte:param name="search_field_video_attachment_notnull" value="1" />
                <vte:param name="search_cid" value="{CURRENT_CATEGORY.get_id}" />
                <vte:param name="cache" value="1" />
                <vte:param name="search_sort_by" value="most_commented" />
                <vte:param name="search_limit" value="5" />
            </vte:params>
            <vte:template>
                <div id="videos_most_commented">
                    <vte:foreach item = "article" from = "{article_list}" key="commented">
                        <vte:include file="{VIVVO_TEMPLATE_DIR}summary/video_short.tpl" />
                    </vte:foreach>
                </div>
            </vte:template>
        </vte:box>
    
    </div>
    
    <script type="text/javascript">
		var tabs_videos = new Control.Tabs('tabs_videos');
		
            $$('a.play').each(
                function (elem) {
                    $(elem).observe('click', playerLoad);
                }
            );
            
            playerLoad($$('a.play').first()); 
           
        
        
       function playerLoad (elem) {
            if (elem.element) {
                Event.stop(elem);
                elem = elem.findElement('a');
            }
         
            
            var id = elem.id.replace(/video_article_/, '');
            new Ajax.Updater('player_article', '<vte:value select="{VIVVO_ABSOLUTE_URL}" />', {
                parameters: {
                    video_holder_id: <vte:value select="{video_holder_id|json_encode}" />,
                    search_id: id,
                    template_output: 'box/plugin_video_article'
                  
                },
                method: 'get',
                evalScripts: true
            });
        }
	</script>
    <div class="clearer"> </div>
</div>