@extends("frontend.desktop.layouts.default")
@section("page-title"){{$category->category_name}}@stop
@section("page-des"){{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-keyword"){{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$category->category_name}}" href="{{\App\Helper\Common::cat_link(null,"rss",$category->id)}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}feed/index.rss" />
@stop
@section("seo")
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{$alternate}}" hreflang="en" />
    <link rel="canonical" href="{{$canonical}}"/>
    <meta name="twitter:url" content="{{$canonical}}"/>
    <meta name="twitter:title" content="{{$category->category_name}}"/>
    <meta name="twitter:description" content="{{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}"/>
    <meta name="twitter:image" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
    <meta property="og:url" content="{{$canonical}}"/>
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="450"/>
@stop
@section("header_menu")
    @include('frontend.desktop.box.header')
    @include("frontend.desktop.adv.headline_banner")
@stop
@section("content")
    <div id="container">
        <!--<vte:include file="{VIVVO_TEMPLATE_DIR}box/social_network_tabs_sw24_v2.tpl" />-->
        @include("frontend.desktop.adv.ad_tabs")
        @include("frontend.desktop.box.ticker_typer",[$arrTicker])
        <div id="content">
            <div id="dynamic_box_center">
                <div id="box_center_holder">
                    <img class="short_header" src="{{$fileRepo->getDesktopUrl("img/header_sp.png")}}" width="650" />

                    @include("frontend.desktop.box.rotating_headlines_list_v_2",[$setting,$sportHeadlines,$fileRepo])
                    <div class="headline_banner">@include("frontend.desktop.adv.under_headlines_sport")</div>
                    @include("frontend.desktop.box.column_center_sport",$columnCenterSport)
                </div>
            </div>
            <div id="dynamic_box_right">
                <div id="box_right_holder">
                    @include("frontend.desktop.box.column_left_sport",$columnLeftSport)
                </div>
            </div>
            <div class="clearFix"><!--asd--></div>
    </div>
@stop
@section("styles")
    <link media="all" type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/category_sport'.Config::get('app.css_extend').'.css') }}">
@stop
@section("header_scripts")
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js?v='.Config::get('app.home_js_version')) }}"></script>
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/rotating_headlines.js?v=1') }}"></script>
@stop
