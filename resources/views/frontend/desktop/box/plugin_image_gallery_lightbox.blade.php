<div class="box box_gray">
    <h3 class="box_title title_gray">{{Config::get("site.lang.LNG_PLUGIN_IMAGE_GALLERY_BOX_TITLE")}}</h3>
    <div class=" plugin_image_holder">
        @foreach($galleries as $gallery)
           <span class="lightbox_image" style="width:{{$setting["VIVVO_SUMMARY_SMALL_IMAGE_WIDTH"]}}px; height:{{$setting["VIVVO_SUMMARY_SMALL_IMAGE_WIDTH"]}}px;"><a href="{{$fileRepo->getLarge($gallery->real_path)}}" rel="lightbox[gallery]" title="{{$gallery->title}}"><img width="{{$setting["VIVVO_SUMMARY_SMALL_IMAGE_WIDTH"]}}" src="{{$fileRepo->getSummarySmall($gallery->real_path)}}" title="{{$gallery->title}}" alt="{{$gallery->title}}" /></a></span>
        @endforeach
    </div>
</div>
