<div class="box1 box_white1">
			<div id="category_news_box" >
				<div class="main_news_box_row">
				<h3 class="box_title_policy title_policy">أهم الأخبار</h3>
				</div>
				<div id="latest_news_two" class="box_two box_white_two">
					@foreach($newsR00 as $article)
							<div class="short_policy">
								<div class="short_holder_policy">
									@if($article->image)
										<div class="image">
											<a href="{{Common::article_link($article)}}">
												<img src="{{$fileRepo->getSmall($article->image,true,$article->md5_file)}}" width="135" height="90" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
											</a>
										</div>
									@endif
									<h2 class="article_title_two_one"><a href="{{Common::article_link($article)}}">{{$article->title}}</a></h2>
									<p>
										{{$article->abstract?$article->abstract:Common::subWords($article->body,25)}} @if($article->body)...@endif
										@if(!$article->link)
                                            @if($article->body)
												<span class="mor_full"><a href="{{Common::article_link($article)}}"> {{Config::get("site.lang.LNG_FULL_STORY")}}</a></span>
											@endif
                                        @else
                                            <a class="visit" href="{{$article->link}}"><img src="{{$fileRepo->getDesktopUrl("img/external.png")}}" alt="{{Config::get("site.lang.LNG_VISIT_WEBSITE")}}" /></a>
										@endif
									</p>
								</div>
							</div>
					@endforeach
				</div>
			</div>
</div>
