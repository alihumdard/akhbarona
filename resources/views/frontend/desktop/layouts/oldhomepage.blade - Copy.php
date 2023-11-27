<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" lang="ar-MA" xml:lang="ar-MA" dir="rtl">
<head>
    <title>@yield('page-title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="generator" content="Akhbarona almaghrebia"/>
    <meta name="Description" content="@yield('page-des')"/>
    <meta name="Keywords" content="@yield('page-keyword')"/>
    @yield("rss")
    <meta property="og:site_name" content="akhbarona.com"/>
    <meta property="og:type" content="website"/>
    <meta content="@yield('page-des')" itemprop="description" property="og:description"/>
    <meta name="copyright" content="akhbarona.com"/>
    <meta name="author" content="akhbarona.com"/>
    <meta name="robots" content="index, follow"/>

    <?php $cdnUrl = Config::get('app.cdn_url_css');?>
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
    @yield("seo")
    <meta property="og:title" content="@yield('page-title')" itemprop="headline"/>
    <meta name="twitter:site" content="@AkhbaronaPress"/>
    <meta name="twitter:creator" content="@AkhbaronaPress"/>
    <meta name="google-site-verification" content="nH8QuQxqHItGHazk4RR7Gg5b2v0WdVjoK1blBiEgKcQ"/>
    @yield("og_image")
    <meta property="og:title" content="@yield('page-title')" itemprop="headline"/>
    @yield("styles")
    @include("frontend.desktop.system.html_header_homepage")
    @yield("header_scripts")
</head>
<body id="layout_two_column" cz-shortcut-listen="true">
@yield("header_menu")

@yield("content")
@include("frontend.desktop.layouts.footer")
</div>

@yield("scripts")
</body>
</html>
