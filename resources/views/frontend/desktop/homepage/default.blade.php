@extends("frontend.desktop.layouts.homepage")
@section("page-title"){{$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-des"){{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}@stop
@section("page-keyword"){{$setting["VIVVO_GENERAL_META_KEYWORDS"]}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}feed/index.rss" />
@stop
@section("seo")
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{Config::get("app.url")}}mobile" hreflang="en" />
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
@section("header_menu")
    @include('frontend.desktop.box.header')
    @include("frontend.desktop.adv.headline_banner")
@stop
@section("content")
<div id="container">
    @include("frontend.desktop.adv.ad_tabs_home")
    @include("frontend.desktop.box.ticker_typer_homepage",[$arrTicker])
    <div id="content">
        <div id="dynamic_box_center">
            <div id="box_center_holder">
                <div id="content_features" class="features_equal_default">
                    <div id="content_features_left">
                        @include("frontend.desktop.box.latest_news_bh_sw",[$latestNewsBhSw,$fileRepo])
                    </div>
                    <div id="content_features_right">
                        @include("frontend.desktop.box.fancy_headlines",[$fancyHeadlines,$fileRepo,$setting])
                    </div>
                </div>
                @include("frontend.desktop.box.column_center",$columnCenter)
            </div>
        </div>
        <div id="dynamic_box_right">
            <div id="box_right_holder">
                @include("frontend.desktop.box.column_left",$columnLeft)
            </div>
        </div>
        <div class="clearFix"><!--asd--></div>
    </div>

@stop
@section("styles")
    <link media="all" type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/homepage'.Config::get('app.css_extend').'.css') }}">
@stop
@section("header_scripts")
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js?v='.Config::get('app.home_js_version')) }}"></script>
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/rotating_headlines.js?v=1') }}"></script>
@stop
