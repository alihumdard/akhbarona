<div class="menu_under_ads">@include("frontend.mobile.adv.footer")</div>
<div class="footer_top">
    <?php $appUrl = Config::get("app.url");?>
    <ul class="row_foot_01">
        <li><a href="{{$appUrl}}mobile/religion/index.1.html">دين ودنيا</a></li>
        <li><a href="{{$appUrl}}mobile/economy/index.1.html">اقتصاد</a></li>
        <li><a href="{{$appUrl}}mobile/health/index.1.html">طب وصحة</a></li>
        <li><a href="{{$appUrl}}mobile/politic/index.1.html">سياسة</a></li>
        <li><a href="{{$appUrl}}mobile/technology/index.1.html ">علوم وتكنولوجيا</a></li>
        <li><a href="{{$appUrl}}mobile/national/index.1.html">أخبار وطنية</a></li>
        <li><a href="{{$appUrl}}mobile/education">مستجدات التعليم</a></li>
        <li><a href="{{$appUrl}}mobile/sport/index.1.html">رياضة</a></li>
        <li><a href="{{$appUrl}}mobile/advertising.html">للإشهار في الموقع</a></li>
        <li><a href="{{$appUrl}}mobile/world/index.1.html">دولية</a></li>
        <li><a href="{{$appUrl}}mobile/conditions.html">شروط استخدام الموقع</a></li>
        <li><a href="{{$appUrl}}mobile/videos">شاشة أخبارنا</a></li>
        <li><a href="{{$appUrl}}mobile/contact.html">إتصل بنا</a></li>
        <li><a href="{{$appUrl}}mobile/last/index.1.html">الأخـيـرة</a></li>
    </ul>
	<div class="clearfix"></div>
</div>
<div class="footer">
<p>جميع الحقوق محفوظة  أخبارنا المغربية &copy; {{date("Y")}}</p>
<hr/>
<p>
			<a href="javascript:bookmarksite(document.URL);">{{Config::get("site.lang.LNG_ADD_FAVORITES")}}</a>
            | <a href="{{$appUrl}}mobile/feed/index.rss">Rss</a> / <a href="{{$appUrl}}mobile/feed/index.atom">Atom</a>
			</p>
      </div>
<?php $cdnUrl = Config::get('app.cdn_url');?>
<script src="{{$cdnUrl}}themes/mobile/assets/js/bootstrap.min.js"></script>
<script src="{{$cdnUrl}}themes/mobile/assets/js/docs.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{$cdnUrl}}themes/mobile/assets/js/ie10-viewport-bug-workaround.js"></script>
