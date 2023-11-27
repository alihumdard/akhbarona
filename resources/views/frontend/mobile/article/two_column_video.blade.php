@extends("frontend.mobile.layouts.default")
@section("page-title"){{$article->title}}@stop
@section("page-des"){{$article->description?$article->description:($article->abstract?$article->abstract:(Common::subWords($article->body,25)?htmlentities(Common::subWords($article->body,25)):$article->title))}}@stop
@section("page-keyword"){{$keywords}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$article->title}}" href="{{\App\Helper\Common::article_rss($article)}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$article->category_name}}" href="{{\App\Helper\Common::cat_link($article,"rss")}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}mobile/feed/index.rss" />
@stop
@section("seo")
    <link rel="canonical" href="{{Common::article_link($article,true)}}"/>
    <meta name="twitter:url" content="{{Common::article_link($article,true)}}"/>
    <meta name="twitter:title" content="{{$article->title}}"/>
    <meta name="twitter:description" content="{{$article->description?$article->description:($article->abstract?$article->abstract:(Common::subWords($article->body,25)?htmlentities(Common::subWords($article->body,25)):$article->title))}}"/>
    <meta name="twitter:image" content="{{$metaImage}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$metaImage}}"/>
    <meta property="og:url" content="{{Common::article_link($article,true)}}"/>
    @if(isset($setting["VIVVO_ARTICLE_LARGE_IMAGE_WIDTH"]))
        <meta property="og:image:width" content="{{$setting["VIVVO_ARTICLE_LARGE_IMAGE_WIDTH"]}}"/>
    @endif
    @if(isset($setting["VIVVO_ARTICLE_LARGE_IMAGE_HEIGHT"]))
        <meta property="og:image:height" content="{{$setting["VIVVO_ARTICLE_LARGE_IMAGE_HEIGHT"]}}"/>
    @endif
@stop
@section("adv_header")
    <div class="clearfix"></div>
    <div class="menu_under_ads">
        @include("frontend.mobile.adv.top")
    </div>
@stop
@section("content")
    <div id="page">
        <div class="middle_container">

            <div class="mid_part">

                <div class="article_details_part">


                    <div class="clearfix"></div>
                    <h3 class="article_head">{{$article->title}}</h3>

                    <div class="article_head_02"><a
                            href="{{route("frontend.category.index",[$category->sefriendly,1])}}">{{$category->category_name}}</a>
                    </div>


                    @if(isset($setting["VIVVO_ARTICLE_SHOW_DATE"]) && $setting["VIVVO_ARTICLE_SHOW_DATE"])
                        <p class="art_time_date">{{Common::pretty_date($article->created)}}</p>
                    @endif
                    <p class="art_det">
                        @if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR"])
                            @if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"])
                                <a href="javascript:;">
                                    {{$article->author}}
                                </a>
                            @else
                                {{$article->author}}
                            @endif

                        @endif
                    </p>
                    @if($article->abstract)
                        <p class="article_abstract">{{$article->abstract}}</p>
                    @endif
                    <h5 class="article_head"></h5>
                    <p>
                       <!--{!! $article->body !!}-->
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
                    </p>
                    <p>
                        @include("frontend.mobile.box.social_facebook",[$article])
                    </p>
                    <p>
                        @include("frontend.mobile.box.article_social_bookmarks",[$article,$setting,$fileRepo])
                    </p>


                    <div class="menu_under_ads2 head_lines">
                        @include("frontend.mobile.adv.banner_1")
                    </div>


                    <p>
                        @if($article->show_comment)
                            @include("frontend.mobile.box.comments",[$comments,$fileRepo,$setting,$commentPages,"security"=>$article->security,$isAdmin])
                        @endif
                    </p>

                    <div class="menu_under_ads">
                        @include("frontend.mobile.adv.banner_23t")
                    </div>
                    <div class="menu_under_ads2 head_lines">
                        @include("frontend.mobile.adv.banner_2")
                    </div>

                    <div class="bg-grey">
                        <ul class="breadcrumb-red">
                            <li class="active">
                                <a title="المزيد في شاشة أخبارنا" href="{{Config::get("app.url")}}mobile/videos">شاشة أخبارنا</a>
                            </li>

                        </ul>

                        <div class="clearfix"></div>
                        @if(count($videos) > 0)
                            <div class="head_line_video">
                                <div class="head_lines">

                                    <!-- <div class="head_cmd">27</div> -->

                                    <div class="head_title"><a href="{{Common::article_link($videos[0])}}">{{$videos[0]->title}}</a></div>

                                    <div class="video-img"><a href="{{Common::article_link($videos[0])}}">
                                            <img class="lazyload" data-src="{{$fileRepo->getLarge($videos[0]->image,true,$videos[0]->md5_file)}}" alt="{{$videos[0]->image_caption?$videos[0]->image_caption:$videos[0]->title}}" />


                                        </a></div>

                                </div>
                                <div class="play-video-1col">
                                    <img class="lazyload" src="{{Config::get("app.cdn_url")}}themes/mobile/assets/img/youtube_play_button.png"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <ul class="ul-grid">
                                @for($index=1;$index < count($videos);$index++)
                                    <li class="video">
                                        <div class="spo_zone" >
                                            <p>
                                                <a href="{{Common::article_link($videos[$index])}}">
                                                    <img class="lazyload" data-src="{{$fileRepo->getMedium($videos[$index]->image,true,$videos[$index]->md5_file)}}" alt="{{$videos[$index]->image_caption?$videos[$index]->image_caption:$videos[$index]->title}}" />

                                                </a>

                                            </p>

                                            <p class="green_zone" style="padding-left: 5px !important;"><a href="{{Common::article_link($videos[$index])}}">{{html_entity_decode($videos[$index]->title)}}</a></p>

                                        </div>
                                        <div class="play-video-2col">
                                            <img class="lazyload" data-src="{{Config::get("app.cdn_url")}}themes/mobile/assets/img/youtube_play_button.png"/>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        @endif

                        <div class="clearfix"></div>
                    </div>

                    <div class="menu_under_ads">
                        @include("frontend.mobile.adv.banner_3")
                    </div>
                    <ul class="breadcrumb2">
                        <li class="active">المواضيع الأكثر مشاهدة</li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="head_lines">
                        @foreach($popularBox as $article)
                            <div class="other_news_01">
                                <h4 class="oth_news_head"><a href="{{\App\Helper\Common::article_link($article)}}">
                                        {{$article->title}}
                                    </a></h4>
                                <p class="oth_news_cont">&nbsp;{{$article->abstract?$article->abstract:Common::subWords($article->body,25)}}
                                    ...<a href="{{\App\Helper\Common::article_link($article)}}"> تفاصيل أكثر </a></p>
                            </div>
                        @endforeach
                    </div>

                    <div class="menu_under_ads">
                        @include("frontend.mobile.adv.banner_4")
                    </div>

                    <iframe
                        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fakhbaronacom%2F&tabs=timeline&width=320&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                        width="320" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowTransparency="true" allow="encrypted-media"></iframe>

                </div>

            </div>

        </div>
    </div>

<!-- Video js Changes -->	
@include("frontend.videojs")
<!--------------------->		
@stop
