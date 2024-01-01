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
                                <?php $articles = $arrData["data"];$article = $articles[0];unset($articles[0]);?>
                                @include("frontend.desktop.summary.vertical",["slug"=>$category->sefriendly,$article,$fileRepo,$setting])
                                <center>@include("frontend.desktop.adv.insection")</center>
                                @foreach($articles as $article)
                                    @include("frontend.desktop.summary.default",["slug"=>$category->sefriendly,$article,$fileRepo,$setting])
                                @endforeach
                                @if($parent)
                                    @include("frontend.desktop.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.level2","routeParam"=>["parent"=>$parent,"slug"=>$category->sefriendly,"page"=>1]])
                                @else
                                    @include("frontend.desktop.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.index","routeParam"=>["slug"=>$category->sefriendly,"page"=>1]])
                                @endif
                            @else
                                <h5 class="subtitle">{{Config::get("site.lang.LNG_NO_ENTRIES")}}</h5>
                            @endif
					</div>
				</div>
				<div id="dynamic_box_right">
					<div id="box_right_holder">
						<div class="headline_banner">@include("frontend.desktop.adv.left_banner_1")</div>
						<div class="headline_banner">@include("frontend.desktop.adv.left_banner_article_2")</div>
                        @include("frontend.desktop.box.popular_box",[$popularBox,$fileRepo])
						@include("frontend.desktop.box.latest_news_sw",[$latestNewsSw,$fileRepo])
						<iframe src="https://www.facebook.com/plugins/likebox.php?locale=ar_AR&amp;href=http%3A%2F%2Fwww.facebook.com%2Fakhbaronacom&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=175996969140016" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:258px;" allowTransparency="true"></iframe>
						<div class="headline_banner">@include("frontend.desktop.adv.left_banner_3")</div>
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
    <script src="{{ url(Config::get('app.cdn_url_css').'themes/akhbarona210/js/homepage.js?v='.Config::get('app.home_js_version')) }}"></script>
@stop
