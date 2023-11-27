<vte:box module="box_users">
    <vte:params>
        <vte:param name="search_sort_by" value="last_name" />
        <vte:param name="search_order" value="descending" />
        <vte:param name="search_limit" value="10" />
        <vte:param name="search_user_type" value="14" />
    </vte:params>
    <vte:template>
        <div class="box box_white">
            <h3 class="box_title title_white"><vte:value select="{LNG_BLOGGERS}" /></h3>
            <vte:foreach item = "user" from = "{user_list}">
                <div class="blogger_info">
                    <vte:if test="{user.picture}">
                        <div class="image"><a href="{user.get_href}"><img src="{user.get_picture_href|'summary_small'}" alt="{user.get_name}" /></a></div>
                    </vte:if>
                    <h3><a href="{user.get_href}"><vte:value select="{user.get_name}" /></a></h3>
                    <vte:value select="{user.get_bio}" />
                    <div class="clearer"> </div>
                </div>
            </vte:foreach>
        </div>
    </vte:template>
</vte:box>
