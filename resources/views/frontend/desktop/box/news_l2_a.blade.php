@if(count($newL2A))
	<div class="white_box">
		<div class="white_box_top"><!--fds--></div>
		<div class="white_box_mid">
			<a title="المزيد في أقلام حرة" href="{{Config::get("app.url")}}writers"><h3 class="box_title title_gray">أقلام حرة</h3></a>
			<div class="box box_white">

                <div id="mainTicker" class="ticker_summary_sw">
                    <div style="overflow:hidden;" class="scroller">
                        @foreach($newL2A as $index=>$article)
                            <div id="ticker_{article.id}" class="section row_{{$index%2}}">
                                @include("frontend.desktop.box.article_image",[$article,$fileRepo,"width"=>50,"height"=>65,"fnc"=>"getSummaryMedium"])
                                <h3><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h3>
                                <div class="story_stamp_sw">
                                    @if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR"])
                                        @if(isset($setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"]) && $setting["VIVVO_ARTICLE_SHOW_AUTHOR_INFO"])
                                            <span class="story_author_sw"><a href="#">{{$article->author}}</a></span>
                                        @else
                                            <span class="story_author_sw">{{$article->author}}</span>
                                        @endif
                                    @endif
                                </div>
                                <div class="clearer"> </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <script type="text/javascript">
                    var mainTicker = new vivvoTicker('mainTicker');
                </script>
			</div>
		</div>
		<div class="white_box_bottom"><!--fds--></div>
	</div>
@endif
