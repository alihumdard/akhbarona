@extends("frontend.mobile.layouts.default")
@section("page-title"){{$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-des"){{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}@stop
@section("page-keyword"){{$setting["VIVVO_GENERAL_META_KEYWORDS"]}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}mobile/feed/index.rss" />
@stop
@section("seo")
    <link rel="canonical" href="{{Config::get("app.url")}}"/>
    <meta name="twitter:url" content="{{Config::get("app.url")}}"/>
    <meta name="twitter:title" content="{{$setting["VIVVO_WEBSITE_TITLE"]}}"/>
    <meta name="twitter:description" content="{{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}"/>
    <meta name="twitter:image" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
    <meta property="og:url" content="{{Config::get("app.url")}}"/>
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="450"/>
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
        @foreach($articleTags as $index=>$article)

            <div class="head_lines">



              <div class="head_name">{{$article->category_name}}</div>

              <div class="head_time_l">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$article->created)->format("h:i")}}</div>

              <!-- <div class="head_cmd">27</div> -->

              <div class="head_title"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></div>

              <div class="head_lines_img"><a href="{{Common::article_link($article)}}">
                <img id="defaultDemo" class="lazyload" data-src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="442" height="300" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />

            </a></div>

            </div>
            @if($index == 9 || ($index > 10 && $index%10==0))
                <div class="menu_under_ads2 head_lines">
                    @include("frontend.mobile.adv.banner_1")

                </div>
            @endif

        @endforeach


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
                        <img class="lazyload" data-src="{{Config::get("app.cdn_url")}}themes/mobile/assets/img/youtube_play_button.png"/>
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

                                <p class="green_zone"><a href="{{Common::article_link($videos[$index])}}">{{html_entity_decode($videos[$index]->title)}}</a></p>

                            </div>
                            <div class="play-video-2col">
                                <img src="{{Config::get("app.cdn_url")}}themes/mobile/assets/img/youtube_play_button.png"/>
                            </div>
                        </li>
                    @endfor
                </ul>
            @endif

            <div class="clearfix"></div>
        </div>


        <div class="menu_under_ads2 head_lines">
            @include("frontend.mobile.adv.banner_3")
        </div>
        <div class="bg-grey">
            <ul class="breadcrumb-purple">
              <li class="active"><a title="المزيد في رياضة" href="{{Config::get("app.url")}}mobile/sport">رياضة</a></li>
            </ul>
            <div class="clearfix"></div>
            @if(count($sports) > 0)
                <div class="head_lines">

                    <!-- <div class="head_cmd">27</div> -->

                    <div class="head_title"><a href="{{Common::article_link($sports[0])}}">{{$sports[0]->title}}</a></div>

                    <div class="head_lines_img"><a href="{{Common::article_link($sports[0])}}">
                            <img id="defaultDemo" class="lazyload" data-src="{{$fileRepo->getLarge($sports[0]->image,true,$sports[0]->md5_file)}}" height="442" alt="{{$sports[0]->image_caption?$sports[0]->image_caption:$sports[0]->title}}" />

                        </a></div>
                </div>
                <div class="clearfix"></div>
                <ul class="ul-grid">
                    @for($i=1;$i < count($sports);$i++)
                        <li><div class="spo_zone">
                          <p><a href="{{Common::article_link($sports[$i])}}"><img class="lazyload" data-src="{{$fileRepo->getMedium($sports[$i]->image,true,$sports[$i]->md5_file)}}" alt="{{$sports[$i]->image_caption?$sports[$i]->image_caption:$sports[$i]->title}}" /></a></p>

                          <p class="green_zone"><a href="{{Common::article_link($sports[$i])}}">{{html_entity_decode($sports[$i]->title)}}</a></p>
                        </div></li>
                       @endfor
                    </ul>
                <div class="clearfix"></div>
            @endif
        </div>

        <div class="menu_under_ads2 head_lines">
            @include("frontend.mobile.adv.banner_4homepage")
        </div>

        <ul class="breadcrumb">

          <li class="active">أخبار أخرى</li>

        </ul>

        <div class="clearfix"></div>

             <div class="head_lines">


        @foreach($footerArticle as $article)

          <div class="other_news_01">

            <h4 class="oth_news_head"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h4>

            <p class="oth_news_cont">&nbsp;{{Common::subWords($article->abstract?$article->abstract:$article->body,25)}}...<a href="{{Common::article_link($article)}}"> تفاصيل أكثر </a></p>

          </div>

          @endforeach
          </div>
    </div>

    </div>

  </div>
@stop
