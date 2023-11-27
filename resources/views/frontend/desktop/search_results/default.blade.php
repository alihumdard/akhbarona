@extends("frontend.desktop.layouts.default")
@section("page-title")نتيجة البحث@stop
@section("page-des"){{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}@stop
@section("page-keyword"){{$setting["VIVVO_GENERAL_META_KEYWORDS"]}}@stop
@section("seo")
    <link rel="canonical" href="{{Config::get("app.url")}}"/>
    <meta name="twitter:url" content="{{Config::get("app.url")}}"/>
    <meta name="twitter:title" content="نتيجة البحث"/>
    <meta name="twitter:description" content="{{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}"/>
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
            @include("frontend.desktop.box.ticker_typer_homepage",[$arrTicker])
            <div class="page_top"> </div>
			<div id="content">
				<div id="dynamic_box_center">
					<div id="box_center_holder">
                        <h1 class="page_title">
                            نتيجة البحث
                        </h1>
                        @include("frontend.desktop.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.desktop.search","routeParam"=>$data])
                        @if(count($arrData["data"]) > 0)
                            @foreach($arrData["data"] as $article)
                                @include("frontend.desktop.summary.default",[$article,$fileRepo])
                            @endforeach
                        @else
                                <h3 class="box_title title_white">{{Config::get("site.lang.LNG_NO_ENTRIES")}}</h3>
                                <h5 class="subtitle">{{Config::get("site.lang.LNG_SEARCH_REFINE")}}:</h5>
                                @include("frontend.desktop.system.advanced_search",[$categories])
                        @endif
                        @include("frontend.desktop.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.desktop.search","routeParam"=>$data])
                        @if($arrData["total"] > 0)
                            <h5 class="subtitle">{{Config::get("site.lang.LNG_SEARCH_NARROW")}}</h5>
                            @include("frontend.desktop.system.advanced_search",[$categories])
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
