<div class="box_content">
	<vte:header type="css" href="{VIVVO_THEME}css/plugin_video.css" />
   <script type="text/javascript" src="{VIVVO_STATIC_URL}js/jw_player.js"> </script>
    <vte:if test="!{video_holder_id}">
		<vte:variable name="video_holder_id" value="video_playlist" />
        <vte:if test="!{video_width}">
            <vte:variable name="video_width" value="640" />
        </vte:if>
        <vte:if test="!{video_height}">
            <vte:variable name="video_height" value="300" />
        </vte:if>
        <div class="player_container">
		 <div id="video_player"> </div>
        </div>
			<div id="player_article">
			</div>
			<script type="text/javascript">
				jwplayer("video_player").setup({
				flashplayer: "<vte:value select="{VIVVO_URL}" />flash/player.swf",
				height:300,
				width: 640,controlbar:'bottom',backcolor:'181818',frontcolor:'EEEEEE'
				});
			</script>	
    </vte:if>
</div>
