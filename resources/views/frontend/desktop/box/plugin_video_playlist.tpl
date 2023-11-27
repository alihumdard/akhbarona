<div class="box_content">
	<vte:header type="css" href="{VIVVO_THEME}css/plugin_video.css" />
    <vte:header type="script" href="{VIVVO_STATIC_URL}js/jw_player.js" />
    <vte:if test="!{video_holder_id}">
		<vte:variable name="video_holder_id" value="video_playlist" />
        <vte:if test="!{video_width}">
            <vte:variable name="video_width" value="600" />
        </vte:if>
        <vte:if test="!{video_height}">
            <vte:variable name="video_height" value="300" />
        </vte:if>
        <div class="player_container">
		<div id="{video_holder_id}"> </div>
		
        </div>
    </vte:if>
    <script type="text/javascript">
		jwplayer(<vte:value select="{video_holder_id|json_encode}" />).setup({
		flashplayer: "<vte:value select="{VIVVO_URL}" />flash/player.swf",
		height: <vte:value select="{video_height}" />,
		width: <vte:value select="{video_width}" />,controlbar:'bottom',backcolor:'181818',frontcolor:'EEEEEE'
		});
    </script> 
    <vte:foreach item="article" key="index" from="{article_list}">
        <div id="{video_holder_id}_{index}">
            <vte:attribute name="class">video_item <vte:if test="{index} = 1">selected</vte:if></vte:attribute>
            <vte:variable name="video" value="{article|get_video_object}" />
            <div class="item_holder">
                <div class="video_button">
                    <a href="#play" onclick="jwplayer('{video_holder_id}').playlistItem({index}-1);return false;" ><img src="{VIVVO_THEME_BANGTD}img/play_button_light.png" alt="{LNG_PLUGIN_VIDEO_BOX_PLAY}" title="{LNG_PLUGIN_VIDEO_BOX_PLAY}" /></a>
                </div>
                <vte:if test="{article.image}">
                    <vte:if test="{article.get_image_caption}">
                        <vte:variable name="image_caption" value="{article.get_image_caption}" />
                        <vte:else>
                            <vte:variable name="image_caption" value="{article.get_title}" />
                        </vte:else>
                    </vte:if>
                    <div class="video_image">
                        <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_small}" alt="{image_caption}" /><br />
                    </div>
                </vte:if>
                <div class="video_title"><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></div>
            </div>
            </div>
			 </vte:foreach>
            	<script type="text/javascript">
					jwplayer(<vte:value select="{video_holder_id|json_encode}" />).load(
					[
					<vte:foreach item="article" from="{article_list}" key="index">
					<vte:variable name="video" value="{article|get_video_object}" />
					{ file:"<vte:value select="{video.file}"/>", image:"<vte:value select="{VIVVO_STATIC_URL}" />files.php?file=<vte:value select="{article.image}" />" }<vte:if test="{article_list|count}!={index}">,</vte:if>
					</vte:foreach>
					]).play();
				</script>	
</div>
