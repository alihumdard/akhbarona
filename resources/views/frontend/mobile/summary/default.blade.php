<div class="head_lines">

  <div class="head_name"><vte:value select="{article.get_category_name}" /></div>

  <div class="head_time_l"><vte:value select="{article.created|format_date:'h:i'}" /></div>

  <!-- <div class="head_cmd">27</div> -->

  <div class="head_title"><a href="{VIVVO_URL}{article.get_href}"><vte:value select="{article.get_title}" /></a></div>

  <div class="head_lines_img"><a href="{VIVVO_URL}{article.get_href}">

    <vte:if test="{article.get_image_caption}">

        <vte:variable name="image_caption" value="{article.get_image_caption}" />

        <vte:else>

            <vte:variable name="image_caption" value="{article.get_title}" />

        </vte:else>

    </vte:if>
    <vte:if test="{article.image}">
    <img class="lazyload" data-src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_large}" width="442" height="300" alt="{image_caption}"  />
  </vte:if>

</a></div>

</div>