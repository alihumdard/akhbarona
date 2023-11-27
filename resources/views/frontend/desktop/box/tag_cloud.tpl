<vte:if test="{VIVVO_MODULES_TAGS}">
    <vte:box module="box_tags">
        <vte:params>
        	<vte:param name="search_not_topic_id" value="1" />
            <vte:param name="search_limit" value="20" />
			<vte:param name="search_advanced_mode" value="1" />
			<vte:param name="set_rating" value="1" />
            <vte:param name="cache" value="1" />
        </vte:params>
        <vte:template>
            <vte:if test="{tag_list}">
                <div id="box_tags" class="box box_gray">
                    <h3 class="box_title title_gray"><vte:value select="{LNG_POPULAR_TAGS}" /></h3>
                    <vte:foreach item = "tag" from = "{tag_list}">
                        <vte:if test="{tag.name} != ''">
                            <a style="font-size:{tag.get_fontsize}px;" href="{tag.get_href}"><vte:value select="{tag.name}" /></a>
                        </vte:if>
                    </vte:foreach>
                    <div class="view_all"><a href="{VIVVO_URL}tag"><vte:value select="{LNG_ALL_TAGS}" /> &raquo;</a></div>
                </div>
            </vte:if>
        </vte:template>
    </vte:box>
</vte:if>