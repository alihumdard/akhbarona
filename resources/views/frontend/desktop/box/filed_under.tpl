<vte:template>
    <div id="box_article_tags" class="box">
        <div class="box_title_holder"><div class="box_title">Filed under:</div></div>
        <div class="box_body">
            <div class="box_content">
                <vte:foreach from="{article.get_topics}" item="topic">
                    <strong><vte:value select="{topic.get_name}" /></strong>:
                    <vte:foreach from="{topic.get_article_tags}" item="tag">
                        <a href="{tag.get_href}"><vte:value select="{tag.get_name}" /></a>
                    </vte:foreach>
                </vte:foreach>
            </div>
        </div>
    </div>
</vte:template>
