<vte:template>
	<div class="short">
		<div class="short_holder">
            <div class="blog_info">
                <div class="blog_date">
                    <p class="blog_month">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$article->created)->format("M")}}</p>
                    <p class="blog_day">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$article->created)->format("d")}}</p>
                    <p>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$article->created)->format("Y")}}</p>
                </div>
                <div class="blog_comments">
                    <span class="no_of_comments"><vte:value select="{article.get_number_of_comments}" /></span>
                </div>
                <span class="comments_label"><vte:value select="{LNG_COMMENTS}" /></span>
                <p><script type="text/javascript" src="https://tweetmeme.com/i/scripts/button.js"> </script></p>
            </div>
			<div class="blog_summary">
            	<h1 class="article_title"><a href="{article.get_href}"><vte:value select="{article.get_title}" /></a></h1>
                <vte:if test="{VIVVO_ARTICLE_SHOW_AUTHOR}">
                    <vte:if test="{VIVVO_ARTICLE_SHOW_AUTHOR_INFO}">
                        <p><vte:value select="{LNG_AUTHOR_BY}" /> <span class="story_author"><a href="{article.get_author_href}"><vte:value select="{article.get_author_name}" /></a></span></p>
                        <vte:else>
                            <p><vte:value select="{LNG_AUTHOR_BY}" /> <span class="story_author"><vte:value select="{article.get_author_name}" /></span></p>
                        </vte:else>
                    </vte:if>
                </vte:if>
                <vte:if test="{article.image}">
                    <div class="image" style="width:{VIVVO_SUMMARY_LARGE_IMAGE_WIDTH}px;">
                        <vte:if test="{article.get_image_caption}">
                            <vte:variable name="image_caption" value="{article.get_image_caption}" />
                            <vte:else>
                                <vte:variable name="image_caption" value="{article.get_title}" />
                            </vte:else>
                        </vte:if>
                        <img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_large}" alt="{image_caption}" />
                        <span class="image_caption"><vte:value select="{article.get_image_caption}" /></span>
                    </div>
                </vte:if>
            	<vte:value select="{article.get_body|200}" />
                <div class="post_tags">
                	<vte:template>
                        <vte:if test="{article.get_tag_links}">
                        	<span class="tags_label"><vte:value select="{LNG_ARTICLE_TAGGED_AS}" />:<br /></span>
                            <vte:foreach from="{article.get_tag_links}" item="tag" key="comma">
                                <a href="{tag.get_href}" title="In {tag.get_group_name}"><vte:value select="{tag.get_name}" /></a><vte:if test="{comma}!={comma_count}">, </vte:if>
                            </vte:foreach>
                            <vte:else>
                                <vte:value select="{LNG_NO_TAGS_FOR_ARTICLE}" />
                            </vte:else>
                        </vte:if>
                    </vte:template>
                </div>
                <vte:if test="!{article.get_link}">
                	<div class="blog_link">
                        <vte:if test="{article.body}">
                            <a href="{article.get_href}"> <vte:value select="{LNG_FULL_STORY}" /></a>
                        </vte:if>
                        <vte:else>
                            <a class="visit" href="{article.get_link}"><img src="{VIVVO_THEME_BANGTD}img/external.png" alt="{LNG_VISIT_WEBSITE}" /></a>
                        </vte:else>
                    </div>
                </vte:if>
            </div>
		</div>
        <vte:include file="{VIVVO_TEMPLATE_DIR}box/article_social_bookmarks.tpl" />
	</div>
</vte:template>
