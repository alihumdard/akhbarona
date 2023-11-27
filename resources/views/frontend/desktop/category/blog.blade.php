@extends("frontend.desktop.layouts.default")
@section("page-title"){{$category->category_name}}@stop
@section("page-des"){{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-keyword"){{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$category->category_name}}" href="{{\App\Helper\Common::cat_link(null,"rss",$category->id)}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}feed/index.rss" />
@stop
@section("seo")
    <link rel="canonical" href="{{route("frontend.category.index",[$category->sefriendly,1])}}"/>
    <meta name="twitter:url" content="{{Config::get("app.url")}}"/>
    <meta name="twitter:title" content="{{$category->category_name}}"/>
    <meta name="twitter:description" content="{{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}"/>
    <meta name="twitter:image" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="450"/>
@stop
@section("header_menu")
    @include('frontend.desktop.box.header')
    @include("frontend.desktop.adv.headline_banner")
@stop
@section("content")
    <div id="container">
        @include("frontend.desktop.box.ticker_typer",[$arrTicker])
        <div class="page_top"> </div>
        <div id="content">
            <div id="dynamic_box_center">
                <div id="box_center_holder">
                    @include("frontend.desktop.box.category_breadcrumb",$category)
                    <h1 class="page_title">
                        {{$category->category_name}}
                    </h1>
                    @if($arrData["total"] > 0)
                        @foreach($articles as $article)
                            @include("frontend.desktop.summary.blog",[$fileRepo,$article])
                        @endforeach
                        @include("frontend.desktop.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.index","routeParam"=>["slug"=>$category->sefriendly,"page"=>1]])
                    @else
                        <h5 class="subtitle">{{Config::get("site.lang.LNG_NO_ENTRIES")}}</h5>
                    @endif
                </div>
            </div>
            <div id="dynamic_box_right">
                <div id="box_right_holder">
                    <vte:include file="{VIVVO_TEMPLATE_DIR}box/bloggers.tpl" />
                    <vte:include file="{VIVVO_TEMPLATE_DIR}box/tag_cloud.tpl" />
                    <vte:include file="{VIVVO_TEMPLATE_DIR}box/popular_posts.tpl" />
                </div>
            </div>
        </div>
        @if(Config::get("site.VIVVO_ANALYTICS_TRACKER_ID"))
            <script type="text/javascript">_gaq.push(['_trackEvent', 'Category', 'View', '{{$category->id}}', 1]);</script>
        @endif
@stop
@section("styles")
    <link media="all" type="text/css" rel="stylesheet" href="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/css/category'.Config::get('app.css_extend').'.css') }}">
@stop
@section("header_scripts")
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js') }}"></script>
@stop
