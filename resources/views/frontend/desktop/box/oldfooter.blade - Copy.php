<?php
$menus = \App\Helper\Common::menus();
$total = count($menus);
$setting = \App\Models\Config::getAllValue();
$mainUrl = Common::mobileLink();
?>
<div class="footer">
    <div id="footer_columns">
    <div id="footer_column_left">
        <div class="footer_logo">
            <a href="{{$mainUrl}}"><img src="{{Config::get("app.cdn_url")}}themes/akhbarona210/img/footer_logo.png" alt="{{$setting["VIVVO_WEBSITE_TITLE"]}}" title="{{$setting["VIVVO_WEBSITE_TITLE"]}}" /></a>
            <div class="static_footer_logo">جميع الحقوق محفوظة</div>
            <div class="static_footer_logo">أخبارنا المغربية © {{date("Y")}} - 2011</div>
        </div>
    </div>
   
    <div id="footer_column_center">
        <h1>Inside footer</h1>
        <div class="footer_center">
            <ul>

                @if($total)
                    @foreach($menus as $menu)
                        <li>
                            <a href="{{Common::link("frontend.category.index",[$menu->sefriendly,1])}}">
                                {{$menu->category_name}}
                            </a>
                        </li>
                    @endforeach
                @endif
                &nbsp;<a href="{{$mainUrl}}last">الأخيرة</a> |
                <a href="{{$mainUrl}}education">مستجدات التعليم</a> |
                <a href="{{$mainUrl}}national">أخبار وطنية</a> |
                <a href="{{$mainUrl}}writers">أقلام حرة</a> |
                <a href="{{$mainUrl}}society">حوادث وقضايا</a> |
                <a href="{{$mainUrl}}woman">ركن المرأة</a> |
                <a href="{{$mainUrl}}problems">مشاكل وحلول</a> |
                <a href="{{$mainUrl}}videos">شاشة أخبارنا</a>
            </ul>
            <div class="static_footer_center">
                <a href="javascript:bookmarksite(document.URL);">{{Config::get("site.lang.LNG_ADD_FAVORITES")}}</a>
                @if(\App\Helper\Common::isMobile())
                    | <a href="{{$mainUrl}}?is_desktop=0">نسخة الموبايل</a>
                @endif
                    | <a href="{{$mainUrl}}feed/index.rss">Rss</a> / <a href="{{$mainUrl}}feed/index.atom">Atom</a>
            </div>
        </div>
    </div>
    <div id="footer_column_right">
        <div class="footer_left">
            <div class="static_footer_left"><a href="{{$mainUrl}}submit.html">للنشر في الموقع</a></div>
            <div class="static_footer_left"><a href="{{$mainUrl}}team.html">فريق العمل</a></div>
            <div class="static_footer_left"><a href="{{$mainUrl}}conditions.html">شروط استخدام الموقع</a></div>
            <div class="static_footer_left"><a href="{{$mainUrl}}contact/">إتصل بنا</a></div>
        </div>
    </div>
    @if(Config::get("site.VIVVO_ANALYTICS_TRACKER_ID"))
        <script type="text/javascript">(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'https://www')+'.google-analytics.com/ga.js';(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(ga);})();</script>
    @endif
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-1600248-7']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'https://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
    </div>
</div>
<script>
    function bookmarksite(url){
        var objTitle = document.getElementsByTagName("title");
        var title = objTitle[0];
        if (window.sidebar) {
            window.sidebar.addPanel(title, url, "");
        } else if(window.opera && window.print) {
            var elem = document.createElement('a');
            elem.setAttribute('href',url);
            elem.setAttribute('title',title);
            elem.setAttribute('rel','sidebar');
            elem.click();
        }
        else if(document.all) {
            window.external.AddFavorite(url, title);
        }
    }
</script>
