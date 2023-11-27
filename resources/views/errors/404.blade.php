<?php $cdnUrl = Config::get('app.cdn_url');?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US" dir="rtl">
<head>
    <title>أخبارنا : جريدة الكترونية مغربية</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="generator" content="Akhbarona almaghrebia"/>
    <meta name="Description" content="جريدة الكترونية مغربية تقدم اخر أخبار المغرب والعالم العربي بالاضافه الي أقوي الفيديوهات والصور"/>
    <meta property="og:site_name" content="akhbarona.com"/>
    <meta property="og:type" content="website"/>
    <meta name="copyright" content="akhbarona.com"/>
    <meta name="author" content="akhbarona.com"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url($cdnUrl.'themes/icons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url($cdnUrl.'themes/icons/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ url($cdnUrl.'themes/icons/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url($cdnUrl.'themes/icons/favicon-16x16.png') }}" sizes="16x16" />
    <meta name="application-name" content="Akhbarona"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ url($cdnUrl.'themes/icons/mstile-144x144.png') }}" />

    <script type="cd8d8a4bfd95ba7c901a6669-text/javascript">
        var _gaq=[['_setAccount','UA-1600248-7'],['_trackPageview']];
    </script>
    <link media="all" type="text/css" rel="stylesheet" href="{{ mix('/akhbarona210/css/homepage.css','themes') }}">
</head>
<body id="layout_default" class="page_not_found">
<div id="container">
    @include('frontend.desktop.box.header_error')
    @include("frontend.desktop.box.ticker_typer_error")
    <div id="content">
        <div class="page_holder">
            <h1 class="page_title">{{Config::get("site.lang.LNG_404_NOT_FOUND")}}</h1>
            <div id="info">
                <div class="page_row" >{{Config::get("site.lang.LNG_404_NOT_FOUND_INFO")}}</div>
                <div class="page_row"  >{{Config::get("site.lang.LNG_404_NOT_FOUND_NOTIFY")}}</div>
            </div>
            <div id="report_404"> </div>
            <strong><a href="{{Config::get("app.url")}}">{{Config::get("site.lang.LNG_404_GO_HOME")}}</a></strong>
        </div>
        <div class="page_top"> </div>
    </div>
    @include("frontend.desktop.layouts.footer")
</div>
</body>
</html>
