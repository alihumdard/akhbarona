<?php $setting = \App\Models\Config::getAllValue();?>
<div id="header">
	<div class="header_image">
		<div id="containers">
            @include("frontend.desktop.box.top_bar")
            <a href="{{Common::mobileLink()}}"><img src="{{Config::get("app.cdn_url")}}themes/akhbarona210/img/logo.png" alt="{{$setting["VIVVO_WEBSITE_TITLE"]}}" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" /></a>
			<div class="clearer"> </div>
		</div>
	</div>
	<div class="clearer"> </div>
</div>
