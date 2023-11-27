 <?php $__env->startSection("page-title"); ?><?php echo e($article->title); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-des"); ?><?php echo e($article->description?$article->description:($article->abstract?$article->abstract:(Common::subWords($article->body,25)?htmlentities(Common::subWords($article->body,25)):$article->title))); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("page-keyword"); ?><?php echo e($keywords); ?><?php $__env->stopSection(); ?> <?php $__env->startSection("rss"); ?> <link rel="alternate" type="application/rss+xml" title="<?php echo e($article->title); ?>" href="<?php echo e(\App\Helper\Common::article_rss($article)); ?>" /> <link rel="alternate" type="application/rss+xml" title="<?php echo e($article->category_name); ?>" href="<?php echo e(\App\Helper\Common::cat_link($article,"rss")); ?>" /> <link rel="alternate" type="application/rss+xml" title="<?php echo e($setting["VIVVO_WEBSITE_TITLE"]); ?>" href="<?php echo e(Config::get("app.url")); ?>feed/index.rss" /> <?php $__env->stopSection(); ?> <?php $__env->startSection("seo"); ?> <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo e(Common::article_link($article,true)); ?>" hreflang="en" /> <link rel="canonical" href="<?php echo e(Common::article_link($article)); ?>"/> <meta name="twitter:url" content="<?php echo e(Common::article_link($article)); ?>"/> <meta name="twitter:title" content="<?php echo e($article->title); ?>"/> <meta name="twitter:description" content="<?php echo e($article->description?$article->description:($article->abstract?$article->abstract:(Common::subWords($article->body,25)?htmlentities(Common::subWords($article->body,25)):$article->title))); ?>"/> <meta name="twitter:image" content="<?php echo e($metaImage); ?>"/> <?php $__env->stopSection(); ?> <?php $__env->startSection("og_image"); ?> <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo e($metaImage); ?>"/> <meta property="og:url" content="<?php echo e(Common::article_link($article)); ?>"/> <?php if(isset($setting["VIVVO_ARTICLE_LARGE_IMAGE_WIDTH"])): ?> <meta property="og:image:width" content="<?php echo e($setting["VIVVO_ARTICLE_LARGE_IMAGE_WIDTH"]); ?>"/> <?php endif; ?> <?php if(isset($setting["VIVVO_ARTICLE_LARGE_IMAGE_HEIGHT"])): ?> <meta property="og:image:height" content="<?php echo e($setting["VIVVO_ARTICLE_LARGE_IMAGE_HEIGHT"]); ?>"/> <?php endif; ?> <?php $__env->stopSection(); ?> <?php $__env->startSection("header_menu"); ?> <?php echo $__env->make('frontend.desktop.box.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.adv.headline_banner", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection("content"); ?> <div id="container"> <?php echo $__env->make("frontend.desktop.adv.ad_tabs_right", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.box.ticker_typer_homepage",[$arrTicker], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <div class="page_top"> </div> <div id="content"> <div id="dynamic_box_center"> <div id="box_center_holder"> <?php echo $__env->make("frontend.desktop.box.article_breadcrumb",[$article,$breadcrumbs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <div id="article_holder"> <h1 class="page_title"><?php echo e($article->title); ?></h1> <div class="story_stamp"> <?php if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR"]): ?> <?php if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"]): ?> <?php echo e(Config::get("site.lang.LNG_AUTHOR_BY")); ?> <span class="story_author"><a href="javascript:;"><?php echo e($article->author); ?></a></span> <?php else: ?> <?php echo e(Config::get("site.lang.LNG_AUTHOR_BY")); ?> <span class="story_author"><?php echo e($article->author); ?></span> <?php endif; ?> <?php endif; ?> <?php if(isset($setting["VIVVO_ARTICLE_SHOW_DATE"]) && $setting["VIVVO_ARTICLE_SHOW_DATE"]): ?> <span class="story_date"><?php echo e(Common::pretty_date($article->created)); ?></span> <?php endif; ?> </div> <?php echo $__env->make("frontend.desktop.box.font_size",[$article,$fileRepo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <div id="article_body"> <div id="box_video_headline_container" style="text-align:center;"> </div> <p><strong><?php echo e($article->abstract); ?></strong></p> <div id="bodystr" class="bodystr"> <?php 
										$modstring = $article->body;
										if($article->enabled_videojs){
											
										$modstring =  str_replace('<iframe','<div class="fwparent"><iframe',$modstring); 
										$modstring =  str_replace('</iframe>','</iframe></div>',$modstring); 
										}
										echo $modstring;
										?>
 </div> <?php if(count($galleries) > 0): ?> <?php echo $__env->make("frontend.desktop.box.plugin_image_gallery_lightbox",[$galleries,$article,$fileRepo,$setting], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?> <?php if(count($attachments) > 0): ?> <?php echo $__env->make("frontend.desktop.box.plugin_multiple_attachments",[$attachments,$article,$fileRepo,$setting], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?> </div> <?php echo $__env->make("frontend.desktop.box.social_facebook",$article, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.box.article_social_bookmarks",$article, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <div class="headline_banner"> <?php echo $__env->make("frontend.desktop.adv.article_bottom", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.adv.article_bottom_2", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div> <?php if($article->show_comment): ?> <?php echo $__env->make("frontend.desktop.box.comments",[$comments,$article,$fileRepo,$setting,$commentPages,"security"=>$article->security,$isAdmin], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?> </div> </div> </div> <div id="dynamic_box_right"> <div id="box_right_holder"> <div class="headline_banner"><?php echo $__env->make("frontend.desktop.adv.left_banner_1", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div> <div class="headline_banner"><?php echo $__env->make("frontend.desktop.adv.left_banner_article_2", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div> <?php echo $__env->make("frontend.desktop.box.news_l1",[$newsL1,$fileRepo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.box.popular_box",[$fileRepo,$popularBox], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make("frontend.desktop.box.category_related",[$article,$categoryRelated], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <iframe src="https://www.facebook.com/plugins/likebox.php?locale=ar_AR&amp;href=http%3A%2F%2Fwww.facebook.com%2Fakhbaronacom&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=175996969140016" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:258px;" allowTransparency="true"></iframe> <div class="headline_banner"><?php echo $__env->make("frontend.desktop.adv.left_banner_3", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div> </div> </div> </div> <?php if(Config::get("site.VIVVO_ANALYTICS_TRACKER_ID")): ?> <script type="text/javascript">_gaq.push(['_trackEvent', 'Article', 'View', '<?php echo e($article->id); ?>', 1]);</script> <?php endif; ?> <?php $__env->stopSection(); ?> <?php $__env->startSection("styles"); ?> <link media="all" type="text/css" rel="stylesheet" href="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/article_detail'.Config::get('app.css_extend').'.css')); ?>"> <?php if(count($galleries) > 0): ?> <link type="text/css" rel="stylesheet" href="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/lightbox.css')); ?>"> <link type="text/css" rel="stylesheet" href="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/plugin_image_gallery.css')); ?>"> <?php endif; ?> <?php $__env->stopSection(); ?> <?php $__env->startSection("header_scripts"); ?> <script src="<?php echo e(url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/article.js?v=1.1')); ?>"></script> <?php echo $__env->make("frontend.videojs", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make("frontend.desktop.layouts.default", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akhabarona\resources\views/frontend/desktop/article/two_column_video.blade.php ENDPATH**/ ?>