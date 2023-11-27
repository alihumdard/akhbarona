@extends("frontend.mobile.layouts.default")
@section("page-title"){{$setting["VIVVO_WEBSITE_TITLE"]}}@stop
@section("page-des"){{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}@stop
@section("page-keyword"){{$setting["VIVVO_GENERAL_META_KEYWORDS"]}}@stop
@section("seo")
    <link rel="canonical" href="{{Config::get("app.url")}}/mobile"/>
    <meta name="twitter:url" content="{{Config::get("app.url")}}/mobile"/>
    <meta name="twitter:title" content="{{$setting["VIVVO_WEBSITE_TITLE"]}}"/>
    <meta name="twitter:description" content="{{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}"/>
    <meta name="twitter:image" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
@stop
@section("og_image")
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$cdnUrl."themes/akhbarona210/img/logo_social.png"}}"/>
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="450"/>
@stop
@section("adv_header")
    <div class="menu_under_ads"> <a href="#"><img src="{{$cdnUrl}}themes/mobile/assets/img/ads-01.gif" /></a> </div>
@stop
@section("content")
      <div id="page">
        <div class="middle_container">

        <div class="mid_part">
            <ul class="breadcrumb">
                <li class="active">نتيجة البحث</li>
            </ul>
            <div class="clearfix"></div>
			<span dir="ltr">
			@include("frontend.mobile.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.search","routeParam"=>$data])
			</span>
            <div class="clearfix"></div>
				 	@if(count($arrData["data"]) > 0)
						@foreach($arrData["data"] as $article)

						 <div class="oth_headlines">
			              <p><a href="{{\App\Helper\Common::article_link($article)}}"><img class="lazyload" style="height: auto !important;" data-src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /></a> <span>

			              	<a href="{{\App\Helper\Common::article_link($article)}}">{{$article->title}}</a>

			              	</span> </p>
			              	<p> <span>
			              		{{\App\Helper\Common::subWords($article->abstract?$article->abstract:$article->body,25)}}
			              		</span>
			              	</p>
			              	<p>
			              	@if($article->link)
								@if($article->body)
									<a href="{{\App\Helper\Common::article_link($article)}}"> {{Config::get("site.lang.LNG_FULL_STORY")}}</a>
								@else
									<a class="visit" href="{{$article->link}}"><img src="{{$fileRepo->getMobileUrl("img/external.png")}}" alt="{{Config::get("site.lang.LNG_VISIT_WEBSITE")}}"/></a>
								@endif
							@endif

							</p>

			            </div>

						@endforeach
						@else
							{{Config::get("site.lang.LNG_NO_ENTRIES")}}
						@endif
		</div>

        </div>
      </div>
@stop
