<link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
<link href="<?php echo url('js/videojs/contrib/videojs-contrib-ads.css');?>" rel="stylesheet" >
 <link href="<?php echo url('js/videojs/videojs.ima.css');?>" rel="stylesheet" />
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
<script src="<?php echo url('js/videojs/youtube.js')?>"></script>
<script type="text/javascript" src="https://imasdk.googleapis.com/js/sdkloader/ima3.js"></script>
<script type="text/javascript" src="<?php echo url("js/videojs/contrib/videojs-contrib-ads.js"); ?>"></script>
<script src="<?php echo url("js/videojs/videojs.ima.js"); ?>"></script>
<script src="<?php echo url("js/videojs/videojs-analytics.min"); ?>"></script>

<script>

var enable_videojs      = false;
var enable_videoad      = false;
var enable_videoautoplay= false;
var enable_fluid        = false;
function returntech(url) {
    var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    if(url.match(p)){
        return true;
    }
    return false;
}
$(document).ready(function(){
	var iframe = document.getElementById('bodystr').getElementsByTagName('iframe');
	var post   = document.getElementById('bodystr'),
    div, n;
	var j      = 0;
	
	for( var i = 0; i < iframe.length; i++ ){
	   var iframet       = document.getElementById('bodystr').getElementsByTagName('iframe')[0];
	   var videowidth    = iframe[0].getAttribute('width');
	   var videoheight   = iframe[0].getAttribute('height');
	   var videofluid    = iframe[0].getAttribute('data-fluid');
	   var videojs       = iframe[0].getAttribute('data-videojs');
	   var videoads      = iframe[0].getAttribute('data-videoads');
	   var videoautoplay = iframe[0].getAttribute('data-videoautoplay');
	   var source        = iframe[0].getAttribute('src');
	   if(videojs=='yes'){
		  
		   const newItem = document.createElement('video');
		   var sourceMP4 = document.createElement("source"); 
		   sourceMP4.type = "video/mp4";
		   sourceMP4.src = source;
		   newItem.appendChild(sourceMP4);
		   newItem.setAttribute('width',videowidth);
		   newItem.setAttribute('height',videoheight);
		   newItem.setAttribute('data-videojs',videojs);
		   newItem.setAttribute('data-fluid',videofluid);
		   newItem.setAttribute('data-videoads',videoads);
		   newItem.setAttribute('data-videoautoplay',videoautoplay);
		   newItem.setAttribute('data-source',source);
		   iframe[0].parentNode.replaceChild(newItem,iframe[0]);
		   newItem.load();
		}else{
			 j++;
		}
	}
	
    var vids = document.getElementsByTagName('video');
    for( var i = 0; i < vids.length; i++ ){ 
		  var video = document.getElementsByTagName('video')[i];
		  
		  video.setAttribute('id', 'video_'+i);
		  video.setAttribute('class', 'video-js');
		  video.setAttribute('controls',1);
		  video.setAttribute('preload','auto');
		  video.load();
	}
});
</script>


<script>


$(document).ready(function(){
	var vids   = document.getElementsByTagName('video');
    	
	for( var i = 0; i < vids.length; i++ ){ 
		  var video = document.getElementsByTagName('video')[i];
		  var videourl = video.getAttribute('data-source');
		  if(videourl==null){
			var videourl = video.currentSrc;  
		  }
		 
		  
		  video.setAttribute('id', 'video_'+i);
		  video.setAttribute('class', 'video-js');
		  video.setAttribute('controls',1);
		  video.setAttribute('preload','auto');
		  video.load();
	      enable_videojs = video.getAttribute('data-videojs');
		  enable_videoad = video.getAttribute('data-videoads');
		
		  if(video.getAttribute('data-fluid')=='yes'){
		  enable_fluid   = true;	  
		  }
		  if(video.getAttribute('data-videoautoplay')=='yes'){
			   console.log('---yes'+videourl);
		       enable_videoautoplay = true;
		  }else{
			   enable_videoautoplay = false;
			   console.log('=====No'+videourl);
		  }
		  if(returntech(videourl)){
			if(enable_videojs=='yes'){
				vgsPlayer = videojs('video_'+i, {
					techOrder: ["youtube"],
					youtube: { "iv_load_policy": 1 },
					autoplay: enable_videoautoplay,
					fluid:enable_fluid,
					sources: [{
					  type: "video/youtube",
					  src: videourl,
					}],
				}) ;
			}
			
		  }else{
			
			if(enable_videojs=='yes'){
				vgsPlayer = videojs('video_'+i, {
					techOrder: ["html5"],
					autoplay: enable_videoautoplay,
					fluid:enable_fluid,
					sources: [{
					  type: "video/mp4",
					  src: videourl,
					}],
				}) ;
				
				
				
            }			 
			 
		  }
		  
		  if(enable_videojs=='yes' && enable_videoautoplay){
					videojs('video_'+i).ready(function(){
						this.play();
					});
					vgsPlayer.muted(true);
		  }
		  if(enable_videojs=='yes' && enable_videoad=='yes'){
			
		  var options = {
			  adTagUrl: 'https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator='
			  };
	      vgsPlayer.ima(options);
		  
		  
		  }
		  if(enable_videojs=='yes'){
		  vgsPlayer.analytics();
		  }

		
   }
 
 
   
});

</script>