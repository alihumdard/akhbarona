<div class="box box_video">
	<vte:header type="css" href="{VIVVO_THEME}css/plugin_video.css" />
	<vte:header type="script" href="{VIVVO_STATIC_URL}js/jw_player.js" />
    <div id="" class="headline_video_player">
		<div id="box_video_headline_container"> </div>
    </div>
    <vte:box module="box_article_list">
        <vte:params>
        	<vte:param name="search_topic_id" value="1" />
            <vte:param name="search_limit" value="5" />
            <vte:param name="search_all_tag_ids" value="1,3" />
            <vte:param name="search_sort_by" value="order_num" />
            <vte:param name="search_order" value="descending" />
            <vte:param name="cache" value="1" />
            <vte:param name="add_to_printed" value="true" />
        </vte:params>
        <vte:template>
        	<div class="headline_video_playlist">
			<script type="text/javascript">
				jwplayer("box_video_headline_container").setup({
				flashplayer: "<vte:value select="{VIVVO_URL}" />flash/player.swf",
				playlist: [
					<vte:foreach item="article" from="{article_list}" key="index">
					<vte:variable name="video" value="{article|get_video_object}" />
					{ file:"<vte:value select="{video.file}"/>", image:"<vte:value select="{VIVVO_STATIC_URL}" />files.php?file=<vte:value select="{article.image}" />" }<vte:if test="{article_list|count}!={index}">,</vte:if>
					</vte:foreach>
					],
				height:240,
				width: 320,controlbar:'bottom',backcolor:'181818',frontcolor:'EEEEEE'
				});
			</script>
                <vte:foreach item="article" from="{article_list}" key="index">
					<vte:variable name="video" value="{article|get_video_object}" />
                    <div class="headline_video_item">
                    	<vte:if test="{article.image}">
                        	<div class="image">
                                <a href="{article.get_href}">
                                    <vte:if test="{article.get_image_caption}">
                                        <vte:variable name="image_caption" value="{article.get_image_caption}" />
                                        <vte:else>
                                            <vte:variable name="image_caption" value="{article.get_title}" />
                                        </vte:else>
                                    </vte:if>
                                    <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_small}" alt="{image_caption}" /><br />
                                </a>
                            </div>
                        </vte:if>
                        <a href="{article.get_href}"><vte:value select="{article.title}" /><vte:if test="{article.get_link}"> <img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}"/></vte:if></a>
                        <a href="#play" onclick="jwplayer('box_video_headline_container').playlistItem({index}-1);return false;"><img src="{VIVVO_THEME_BANGTD}img/play_button.png" class="play_video" alt="{LNG_PLUGIN_VIDEO_BOX_PLAY}" title="{LNG_PLUGIN_VIDEO_BOX_PLAY}" /></a>
                    </div>
                </vte:foreach>
            </div>
        </vte:template>
    </vte:box>
    <div class="clearer"> </div>
</div>
