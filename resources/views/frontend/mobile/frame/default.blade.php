@extends("frontend.mobile.layouts.default")
@section("page-title"){{$page->title}}@stop
@section("page-des"){{$page->title.', '.$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}@stop
@section("page-keyword"){{$page->title}}@stop
@section("seo")
    <link rel="canonical" href="{{Config::get("app.url")}}"/>
    <meta name="twitter:url" content="{{Config::get("app.url")}}"/>
    <meta name="twitter:title" content="{{$setting["VIVVO_WEBSITE_TITLE"]}}"/>
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
    @include("frontend.desktop.adv.headline_banner",[$setting])
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
          	<div id="dynamic_box_center">
					<div id="box_center_holder">
						@if($page->title)
							<ul class="breadcrumb">
								<li class="active" style="font-size:18px;">{{$page->title}}</li>
							</ul>
							<div class="clearfix"></div>
						@endif
						<div class="head_lines">
							<div class="other_news_01">
                                {!! $page->body !!}
							</div>
						</div>
					</div>
				</div>
		</div>
        </div>
      </div>
@stop
