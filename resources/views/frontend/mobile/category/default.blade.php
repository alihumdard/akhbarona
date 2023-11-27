@extends("frontend.mobile.layouts.default")
@section("page-title"){{$category->category_name}}@stop
@section("page-des"){{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-keyword"){{$category->category_name.','.$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("rss")
    <link rel="alternate" type="application/rss+xml" title="{{$category->category_name}}" href="{{\App\Helper\Common::cat_link(null,"rss",$category->id)}}" />
    <link rel="alternate" type="application/rss+xml" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" href="{{Config::get("app.url")}}mobile/feed/index.rss" />
@stop
@section("seo")
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
@section("adv_header")
    <div class="menu_under_ads">
        @include("frontend.mobile.adv.top")
    </div>
@stop
@section("content")
	 @if($category->id == 7)
	 	@include("frontend.mobile.category.sports",[$fileRepo,$cdnUrl,$setting,$category,$page,$arrData,$perPage,$popularBox,$parent])
	@else
		@include("frontend.mobile.category.category",[$fileRepo,$cdnUrl,$setting,$category,$page,$arrData,$perPage,$popularBox,$parent])
	@endif
@stop
