<html xmlns="https://www.w3.org/1999/xhtml" lang="{VIVVO_LANG_CODE}" xml:lang="{VIVVO_LANG_CODE}" dir="rtl">
	<vte:include file="{VIVVO_TEMPLATE_DIR}system/html_header.tpl" />
	<div class="site-wrapper">
	  <div class="site-wrapper-inner">
	    <div class="cover-container">
	<vte:include file="{VIVVO_TEMPLATE_DIR}box/header.tpl" />

	 <div class="menu_under_ads"> <a href="#"><img src="{VIVVO_THEME_BANGTD}assets/img/ads-01.gif" /></a> </div>
      <div id="page">
        <div class="middle_container">
           
          <div class="mid_part">

          	<vte:box module="box_article_list">
				<vte:params>
		            <vte:param name="search_topic_id" value="1" />
		            <vte:param name="search_all_tag_ids" value="1,2" />
					<vte:param name="search_sort_by" value="order_num" />
					<vte:param name="search_order" value="descending" />
					<vte:param name="cache" value="1" />
					<vte:param name="add_to_printed" value="true" />
					<vte:param name="exclude_printed" value="true" />
					<vte:param name="search_limit" value="6" />
				</vte:params>
				<vte:template>
					<vte:foreach item = "article" from = "{article_list}" key="index">	
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
	                    <img id="defaultDemo" src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_large}" width="442" height="300" alt="{image_caption}" />
	                </a></div>
		            </div>
		            </vte:foreach>
				</vte:template>
			</vte:box>
		<vte:box module="box_article_list">
	    <vte:params>
	        <vte:param name="search_sort_by" value="{VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER}" />
	        <vte:param name="search_order" value="descending" />
	        <!--<vte:param name="search_cid" value="32" />-->
	        <vte:param name="search_cid" value="32" />
	        <vte:param name="search_limit" value="12" />
	        <vte:param name="add_to_printed" value="true" />
	        <vte:param name="exclude_printed" value="true" />
	    </vte:params>
	    <vte:template>

		    <ul class="breadcrumb">
              <li class="active"> <a title="المزيد في شاشة أخبارنا" href="{VIVVO_URL}mobile/videos">شاشة</a></li>
            </ul>
            <div class="clearfix"></div>

            <div class="carousel slide" id="myCarousel" dir="ltr">
              <ol class="carousel-indicators">
              	<vte:foreach item = "article" from = "{article_list}" key="i">            

                <li data-slide-to="{i}" data-target="#myCarousel">	<vte:attribute name="class">
                    <vte:if test="{i} = 1"> active </vte:if>
                </vte:attribute></li>              
                </vte:foreach>
              </ol>            
          	

          	 <div class="carousel-inner">
              	<vte:foreach item = "article" from = "{article_list}" key="i">

                <div class="item">
                	<h4 dir="rtl"><a href="{VIVVO_URL}{article.get_href}" style="color:#D78835;"><vte:value select="{article.get_title}" /></a></h4>

                	<vte:attribute name="class">
                    <vte:if test="{i} = 1">item active 
                    <vte:else>
                        item
                    </vte:else>
                	</vte:if>
                </vte:attribute>
					<a href="{VIVVO_URL}{article.get_href}">
					<vte:variable name="image_caption" value="{article.get_image_caption}" />						
						<img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_article_medium}" width="442" height="300" alt="{image_caption}" />
					</a>
                  <div class="carousel-caption">
                    <p style="position:absolute; text-align:center; left:46%; bottom:120px;"> <a href="{VIVVO_URL}{article.get_href}"><img src="{VIVVO_THEME_BANGTD}assets/img/youtube_play_button.png" /></a> </p>
                  </div>
                </div>
                </vte:foreach>
                
              </div>
              <a data-slide="prev" href="#myCarousel" class="left carousel-control">‹</a> 
              <a data-slide="next" href="#myCarousel" class="right carousel-control">›</a>

               
            </div>
             </vte:template>
			</vte:box>

            <div class="menu_under_ads2 head_lines"> <a href="#"><img src="{VIVVO_THEME_BANGTD}assets/img/ads-03.gif" /></a>
            </div>

            <vte:box module="box_article_list">
			<vte:params>
				<vte:param name="search_cid" value="16" />
				<vte:param name="search_sort_by" value="created" />
				<vte:param name="search_order" value="descending" />
				<vte:param name="search_limit" value="5" />
			</vte:params>
			<vte:template>


            <ul class="breadcrumb">
              <li class="active"><a title="المزيد في رياضة" href="{VIVVO_URL}mobile/sport">رياضة</a></li>
            </ul>
            <div class="clearfix"></div>

            	<ul style="margin:0;padding:0;width:100%;">
            	<vte:foreach item = "article" from = "{article_list}" key="i" start="2">
				  
				    <li style="float:left;width:50%;list-style:none;"><div class="spo_zone">
	                  <p><a href="{article.get_href}"><img src="{VIVVO_BANGTD_STATIC_IMG}{article.get_bangtd_summary_large}" width="161" height="110" alt="{image_caption}" /></a></p>
	                  
	                  <p class="green_zone"><a href="{VIVVO_URL}{article.get_href}"><vte:value select="{article.get_title}" /></a></p>
	                </div></li>
	               </vte:foreach>
				</ul>
				<div class="clearfix"></div>
			</vte:template>
		</vte:box>

		<vte:box module="box_article_list">
		 <vte:template>			
			<!-- <vte:params>
				<vte:param name="search_cid" value="16" />
				<vte:param name="search_sort_by" value="created" />
				<vte:param name="search_order" value="descending" />
				<vte:param name="search_limit" value="5" />
			</vte:params>
 -->
			<ul class="breadcrumb">
              <li class="active">آخر الأخبار</li>
            </ul>
            <div class="clearfix"></div>
				 <div class="head_lines">
			<vte:foreach item = "article" from = "{article_list}" key="index">	

              <div class="other_news_01">
                <h4 class="oth_news_head"><a href="{VIVVO_URL}{article.get_href}"><vte:value select="{article.get_title}" /></a></h4>
                <p class="oth_news_cont">&nbsp;<vte:value select="{article.get_summary}" />...<a href="{article.get_href}"> تفاصيل أكثر </a></p>
              </div>
              </vte:foreach>

              </div>            
		</vte:template>
		</vte:box> 

		</div>
        </div>
      </div>
	<vte:include file="{VIVVO_TEMPLATE_DIR}box/footer.tpl" />
	</div>
  </div>
</div>

</html>