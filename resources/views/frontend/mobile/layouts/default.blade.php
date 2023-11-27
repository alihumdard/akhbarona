<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" lang="ar-MA" xml:lang="ar-MA" dir="rtl">
<head>
    <title>@yield('page-title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="generator" content="Akhbarona almaghrebia"/>
    <meta name="Description" content="@yield('page-des')"/>
    <meta name="Keywords" content="@yield('page-keyword')"/>
    <meta property="og:site_name" content="akhbarona.com"/>
    <meta property="og:type" content="website"/>
    <meta content="@yield('page-des')" itemprop="description" property="og:description"/>
    <meta name="copyright" content="akhbarona.com"/>
    <meta name="author" content="akhbarona.com"/>
    <meta name="robots" content="index, follow"/>
    @yield("rss")
    <?php $cdnUrl = Config::get('app.cdn_url_css');?>
    <link rel="icon" href="{{ url($cdnUrl.'themes/icons/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ url($cdnUrl.'themes/icons/favicon.ico')}}" type="image/x-icon"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url($cdnUrl.'themes/icons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url($cdnUrl.'themes/icons/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ url($cdnUrl.'themes/icons/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url($cdnUrl.'themes/icons/favicon-16x16.png') }}" sizes="16x16" />
    <meta name="application-name" content="Akhbarona"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ url($cdnUrl.'themes/icons/mstile-144x144.png') }}" />
    @yield("seo")
    <meta name="twitter:site" content="@AkhbaronaPress"/>
    <meta name="twitter:creator" content="@AkhbaronaPress"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.5/lazysizes.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


    <link rel="stylesheet" type="text/css" href="{{$cdnUrl}}themes/mobile/assets/css/mobile_compress.min.css?v=2.6"/>    
    @yield("og_image")
    <meta property="og:title" content="@yield('page-title')" itemprop="headline"/>
    @yield("styles")

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-1600248-7', 'auto');
        ga('send', 'pageview');

    </script>
    <script type="text/javascript">
        var _gaq=[['_setAccount','UA-1600248-7'],['_trackPageview']];
    </script>


    <script async='async' type="text/javascript" src="https://static.criteo.net/js/ld/publishertag.js"></script>
    <script>
        window.Criteo = window.Criteo || {};
        window.Criteo.events = window.Criteo.events || [];
    </script>

    <script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>

<script>
  googletag.cmd.push(function() {
    googletag.defineSlot('/1019170/Akhbarona_Top_Mobile', [[320, 100], [320, 50], [300, 250]], 'div-gpt-ad-1520681989263-3').addService(googletag.pubads());
    googletag.defineSlot('/1019170/Akhbarona_Mobile_Middle_1', [[300, 600], [300, 250]], 'div-gpt-ad-1520681989263-1').addService(googletag.pubads());
    googletag.defineSlot('/1019170/Akhbarona_Mobile_Middle_2', [[300, 250], [300, 600], [320, 480]], 'div-gpt-ad-1550918872422-0').addService(googletag.pubads());
    googletag.defineSlot('/1019170/Akhbarona_Mobile_Middle_3', [300, 250], 'div-gpt-ad-1520681989263-2').addService(googletag.pubads());
    googletag.defineSlot('/1019170/Ahbarona_Mobile_Network_2', [[300, 250], [300, 600]], 'div-gpt-ad-1545664110651-0').addService(googletag.pubads());
    googletag.defineSlot('/1019170/Ahbarona_Mobile_Network_1', [300, 250], 'div-gpt-ad-1545664467785-0').addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().collapseEmptyDivs();

		        /** BEGIN CRITEO CDB: AFTER GOOGLE SLOT DEFINITIONS, BEFORE ENABLE SERVICES **/
        googletag.pubads().disableInitialLoad();
        Criteo.events.push(function() {
            Criteo.RequestBidsOnGoogleTagSlots(8663, function() {
                Criteo.SetDFPKeyValueTargeting();
                googletag.pubads().refresh();
            }, 2000);
        });
        /** END CRITEO CDB **/

    googletag.enableServices();
  });
</script>

    <!-- Start Alexa Certify Javascript -->
    <script type="text/javascript">
        _atrk_opts = { atrk_acct:"6Y56g1agwt00Oe", domain:"akhbarona.com",dynamic: true};
        (function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
    </script>
    <noscript><img src="https://certify.alexametrics.com/atrk.gif?account=6Y56g1agwt00Oe" style="display:none" height="1" width="1" alt="" /></noscript>
    <!-- End Alexa Certify Javascript -->

    <script async src="//paslsa.com/c/akhbarona.com.js"></script>
    @yield("header_scripts")

</head>
<body>
<div class="site-wrapper">

    <div class="site-wrapper-inner">
        <div class="cover-container">
            @include("frontend.mobile.box.header")
            @yield("adv_header")
            @yield("content")
            @include("frontend.mobile.box.footer")
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function() {
        jQuery("#mobile-menu-open").click(function () {
            jQuery(this).hide();
            jQuery("#mobile-menu-close").show();
        });
        jQuery("#mobile-menu-close").click(function () {
            jQuery(this).hide();
            jQuery("#mobile-menu-open").show();
        });
    });
    function searchMobile() {
        var _keywork = jQuery("#top_search_mobile input[name=search_query]").val();
        if(_keywork) {
            jQuery.post( "{{route("mobile.frontend.postSearch")}}", { search_query:_keywork },function (data) {
                window.location.href = data;
            } );
        }
        return false;
    }
</script>
</body>
</html>
