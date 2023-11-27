<vte:template>
    <div id="box_article_tags" class="box box_white">
        <h3 class="box_title title_white"><vte:value select="{LNG_ARTICLE_TAGGED_AS}" />:</h3>
        <vte:if test="{article.get_tag_links}">
            <vte:foreach from="{article.get_tag_links}" item="tag" key="comma">
                <a href="{tag.get_href}" title="{LNG_IN} {tag.get_group_name}"><vte:value select="{tag.get_name}" /></a><vte:if test="{comma}!={comma_count}">, </vte:if>
            </vte:foreach>
            <vte:else>
                <vte:value select="{LNG_NO_TAGS_FOR_ARTICLE}" />
            </vte:else>
        </vte:if>
    </div>
</vte:template>