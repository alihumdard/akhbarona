<head>
	<base href="{VIVVO_URL}" />
	<title><vte:if test="{PAGE_TITLE}"><vte:value select="{PAGE_TITLE}" /><vte:else><vte:value select="{VIVVO_WEBSITE_TITLE}" /></vte:else></vte:if></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="generator" content="Akhbarona" />
	<meta name="generation-time" content="$generation_time$" />
	
    <link rel="canonical" href="{CANONICAL_URL}" />	

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.5/lazysizes.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	<link rel="search" type="application/opensearchdescription+xml" href="{VIVVO_PROXY_URL}opensearch" title="{VIVVO_WEBSITE_TITLE}" />
	{$meta_names__}
	{$rss__}
	<!-- {$css__} -->
	<link rel="stylesheet" type="text/css" href="{VIVVO_BANGTD_PATH}/assets/css/mobile_compress.min.css?v=1.0"/>
	<vte:if test="{VIVVO_IS_CUSTOM_PATH} == 0">
		<!-- dynamic js -->
        {$scripts__}
		<!-- END -->
	</vte:if>
	<vte:if test="{VIVVO_IS_CUSTOM_PATH} == 1">
		<script type="text/javascript" src="{VIVVO_BANGTD_PATH}/js/__CUSS_BANGTD_JS__?v=1.1"></script>
	</vte:if>
	<script src="{VIVVO_BANGTD_PATH}/assets/js/mobile_compress.min.js"></script>

	<script type="text/javascript">
	$(function() {
	$('nav#menu').mmenu({
	slidingSubmenus: false
	});
	});
</script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1600248-7', 'auto');
  ga('send', 'pageview');

</script>
    <script type="text/javascript">
	jQuery(document).ready(function() {
	if (sessionStorage.getItem('showOnce') !== 'true') {
				jQuery('#popup').show();
	} else{
                jQuery('#popup').hide();
        }
    jQuery('#popup-close').click(function(e) // You are clicking the close button
    {
        jQuery('#popup').fadeOut(); // Now the pop up is hiden.
		sessionStorage.setItem('showOnce','true');

    });

});
	</script>
<meta property="og:image" content="{VIVVO_URL}files/{article.get_image}" />

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

</head>