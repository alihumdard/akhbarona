<div id="box_archive_navigation" class="box box_gray">
	<h3 class="box_title title_gray"><vte:value select="{LNG_ARCHIVE_NAVIGATE}" /></h3>
    <vte:box module="box_author_timeline">
        <vte:params>
            <vte:param name="search_author_id" value="{CURRENT_AUTHOR.get_id}" />
        </vte:params>
        <vte:template>
            <vte:foreach from="{count_list}" item="year">
                <h5 class="subtitle"><vte:value select="{year[label]}" /></h5>
                <ul>
                    <vte:foreach from="{year[data]}" item="month">
                        <li><a href="{month[url]}"><vte:value select="{month[label]}" /> (<vte:value select="{month[count]}" />)</a></li>
                    </vte:foreach>
                </ul>
            </vte:foreach>
        </vte:template>
    </vte:box>
</div>