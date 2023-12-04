@extends("frontend.desktop.layouts.default")
@section("page-title"){{$article->title}}@stop
@section("page-des"){{$article->description?$article->description:($article->abstract?$article->abstract:(Common::subWords($article->body,25)?htmlentities(Common::subWords($article->body,25)):$article->title))}}@stop
@section("page-keyword"){{$keywords}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$article->title}}" href="{{\App\Helper\Common::article_rss($article)}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$article->category_name}}" href="{{\App\Helper\Common::cat_link($article,"rss")}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}feed/index.rss" />
@stop
@section("seo")
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{Common::article_link($article,true)}}" hreflang="en" />
    <link rel="canonical" href="{{Common::article_link($article)}}"/>
    <meta name="twitter:url" content="{{Common::article_link($article)}}"/>
    <meta name="twitter:title" content="{{$article->title}}"/>
    <meta name="twitter:description" content="{{$article->description?$article->description:($article->abstract?$article->abstract:(Common::subWords($article->body,25)?htmlentities(Common::subWords($article->body,25)):$article->title))}}"/>
    <meta name="twitter:image" content="{{$metaImage}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$metaImage}}"/>
    <meta property="og:url" content="{{Common::article_link($article)}}"/>
    @if(isset($setting["VIVVO_ARTICLE_LARGE_IMAGE_WIDTH"]))
        <meta property="og:image:width" content="{{$setting["VIVVO_ARTICLE_LARGE_IMAGE_WIDTH"]}}"/>
    @endif
    @if(isset($setting["VIVVO_ARTICLE_LARGE_IMAGE_HEIGHT"]))
        <meta property="og:image:height" content="{{$setting["VIVVO_ARTICLE_LARGE_IMAGE_HEIGHT"]}}"/>
    @endif
@stop
@section("header_menu")
    @include('frontend.desktop.box.header')
    @include("frontend.desktop.adv.headline_banner")
@stop
@section("content")
    <div id="container">
        @include("frontend.desktop.adv.ad_tabs")
        @include("frontend.desktop.box.ticker_typer_homepage",[$arrTicker])
        <div class="page_top"> </div>
        <div id="content">
            <div id="dynamic_box_center">
                <div id="box_center_holder">
                    @include("frontend.desktop.box.article_breadcrumb",[$article,$breadcrumbs])
                    <div id="article_holder">
                        <h1 class="page_title">{{$article->title}}</h1>
                        <div class="story_stamp">
                            @if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR"])
                                @if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"])
                                    {{Config::get("site.lang.LNG_AUTHOR_BY")}} <span class="story_author"><a href="javascript:;">{{$article->author}}</a></span>
                                @else
                                    {{Config::get("site.lang.LNG_AUTHOR_BY")}} <span class="story_author">{{$article->author}}</span>
                                @endif
                            @endif
                            @if(isset($setting["VIVVO_ARTICLE_SHOW_DATE"]) && $setting["VIVVO_ARTICLE_SHOW_DATE"])
                                <span class="story_date">{{Common::pretty_date($article->created)}}</span>
                            @endif
                        </div>
                        @include("frontend.desktop.box.font_size",[$article,$fileRepo])
                        <div id="article_columns">
                            <div id="article_column_right">
                                <div class="article_tools" >
                                    @include("frontend.desktop.box.latest_news_art_sw",[$latestNewsArtSw])
                                    <div class="headline_banner">@include("frontend.desktop.adv.right_article_160_600")</div>
                                </div>
                            </div>
                            <div id="article_column_center">
                                <div id="article_body">
                                    @if($article->image)
                                        <div class="image" style="width:{{$setting["VIVVO_ARTICLE_MEDIUM_IMAGE_WIDTH"]}}px;">
                                            <img src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="440" height="300" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                                            <span class="image_caption">{{$article->image_caption?$article->image_caption:""}}</span>
                                        </div>
                                        <div style="clear:both;">&nbsp;</div>
                                    
                                    @endif
                                    @if($article->abstract)
                                        <p class="article_abstract">{{$article->abstract}}</p>
                                    @endif
                                    <div id="bodystr" class="bodystr">
										<?php 
										$modstring = $article->body;
										if($article->enabled_videojs){
											
										$modstring =  str_replace('<iframe','<div class="fwparent"><iframe',$modstring); 
										$modstring =  str_replace('</iframe>','</iframe></div>',$modstring); 
										}
										echo $modstring;
										?>
										</div>
                                    @if(count($galleries) > 0)
                                        @include("frontend.desktop.box.plugin_image_gallery_lightbox",[$galleries,$article,$fileRepo,$setting])
                                    @endif
                                    @if(count($attachments) > 0)
                                        @include("frontend.desktop.box.plugin_multiple_attachments",[$attachments,$article,$fileRepo,$setting])
                                    @endif
                                </div>
                            </div>
                        </div>
                        @include("frontend.desktop.box.social_facebook",$article)
                        @include("frontend.desktop.box.article_social_bookmarks",$article)
                        <div class="headline_banner">
                            @include("frontend.desktop.adv.article_bottom")
                            @include("frontend.desktop.adv.article_bottom_2")
                        </div>
                        @if($article->link)
                            <p><a class="visit" href="{{$article->link}}">{{Config::get("site.lang.LNG_FULL_STORY")}} <img src="{{$fileRepo->getDesktopUrl("img/external.png")}}" alt="{{Config::get("site.lang.LNG_VISIT_WEBSITE")}}" /></a></p>
                        @endif
                        @if($article->show_comment)
                            @include("frontend.desktop.box.comments",[$comments,$article,$fileRepo,$setting,$commentPages,"security"=>$article->security,$isAdmin])
                        @endif
                    </div>
                </div>
            </div>
            <div id="dynamic_box_right">
                <div id="box_right_holder">
                    <div class="headline_banner">@include("frontend.desktop.adv.left_banner_1")</div>
                    @include("frontend.desktop.adv.left_banner_article_2")
                    @include("frontend.desktop.box.news_sport_l01",[$newsSportL01,$fileRepo])
                    @include("frontend.desktop.box.news_sport_l02",[$newsSportL02,$fileRepo])
                    @include("frontend.desktop.box.popular_box",[$popularBox,$fileRepo])
                    @include("frontend.desktop.box.category_related",[$categoryRelated])
                    <iframe src="https://www.facebook.com/plugins/likebox.php?locale=ar_AR&amp;href=http%3A%2F%2Fwww.facebook.com%2Fakhbaronacom&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=175996969140016" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:258px;" allowTransparency="true"></iframe>
                    <div class="headline_banner">@include("frontend.desktop.adv.left_banner_3")</div>
                </div>
            </div>
        </div>
    @if(Config::get("site.VIVVO_ANALYTICS_TRACKER_ID"))
        <script type="text/javascript">_gaq.push(['_trackEvent', 'Article', 'View', '{{$article->id}}', 1]);</script>
    @endif
@stop
@section("styles")
    <link media="all" type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/article_detail'.Config::get('app.css_extend').'.css') }}">
    @if(count($galleries) > 0)
        <link type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/lightbox.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/plugin_image_gallery.css') }}">
    @endif
@stop
@section("header_scripts")
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/article.js?v=1.1') }}"></script>
@include("frontend.videojs")
@stop