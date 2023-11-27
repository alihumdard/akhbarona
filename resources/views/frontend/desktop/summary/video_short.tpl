<vte:template>
    <vte:variable name="video" value="{article|get_video_object}" />
    <div class="video_short">
        <vte:if test="{article.get_image_caption}">
            <vte:variable name="image_caption" value="{article.get_image_caption}" />
            <vte:else>
                <vte:variable name="image_caption" value="{article.get_title}" />
            </vte:else>
        </vte:if>
        <div class="image_play">
            <a id="video_article_{article.get_id}" href="{CURRENT_CATEGORY.get_href}#play" class="play">
                <vte:if test="{article.image}">
                    <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_medium}" alt="{image_caption}" />
                    <vte:else>
                        <img src="{VIVVO_THEME_BANGTD}img/play_button_light.png" alt="{LNG_PLUGIN_VIDEO_BOX_PLAY}" title="{LNG_PLUGIN_VIDEO_BOX_PLAY}" />
                    </vte:else>
                </vte:if>
            </a>
        </div>
        <h4><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h4>
    </div>
</vte:template>