@extends("frontend.desktop.layouts.default")
@section("page-title"){{$page->title}}@stop
@section("page-des"){{$page->title.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-keyword"){{$page->title.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("seo")
    <link rel="canonical" href="{{route("frontend.page",[$page->sefriendly])}}"/>
    <meta name="twitter:url" content="{{route("frontend.page",[$page->sefriendly])}}"/>
    <meta name="twitter:title" content="{{$page->title}}"/>
    <meta name="twitter:description" content="{{$page->title.','.$setting["VIVVO_WEBSITE_TITLE"]}}"/>
    <meta name="twitter:image" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="450"/>
@stop
@section("header_menu")
    @include('frontend.desktop.box.header')
@stop
@section("content")
    <div id="container">
        @include("frontend.desktop.adv.ad_tabs_pages")
        @include("frontend.desktop.box.ticker_typer",[$arrTicker])
        <div class="page_top"> </div>
        <div id="content">
            <div id="dynamic_box_center">
                <div id="box_center_holder">
                    <div class="box_white_pages">
                        @include("frontend.desktop.system.box_default.box_form")
                    </div>
                </div>
            </div>
            <div id="dynamic_box_right">
                <div id="box_right_holder">
                    <div class="headline_banner">@include("frontend.desktop.adv.left_banner_article_2")</div>
                    @include("frontend.desktop.box.popular_box",[$fileRepo,$popularBox])
                    @include("frontend.desktop.box.latest_news_sw",[$fileRepo,$latestNewsSw])
                    <iframe src="https://www.facebook.com/plugins/likebox.php?locale=ar_AR&amp;href=http%3A%2F%2Fwww.facebook.com%2Fakhbaronacom&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=175996969140016" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:258px;" allowTransparency="true"></iframe>
                    @include("frontend.desktop.adv.left_banner_3")
                </div>
            </div>
        </div>
        @stop
        @section("styles")
            <link media="all" type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/category'.Config::get('app.css_extend').'.css') }}">
        @stop
        @section("header_scripts")
            <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js') }}"></script>
@stop
