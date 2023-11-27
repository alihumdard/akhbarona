<div class="box box_gray">
    <h3 class="box_title title_gray">{{Config::get("site.lang.LNG_ATTACHMENTS")}}</h3>
    <div class=" plugin_image_holder">
        @foreach($attachments as $att)
            <div class="content_attachment">
                <img src="{{$fileRepo->getDesktopUrl("img/attachment.gif")}}" alt="{{Config::get("site.lang.LNG_DOWNLOAD_ATTACHMENT")}}" title="{{Config::get("site.lang.LNG_DOWNLOAD_ATTACHMENT")}}" />
                <a href="{{route("attacheFile",[base64_encode($att->real_path)])}}" class="desc" title="{{$att->description}}">
                    {{$att->title?$att->title:$att->real_path}}
                </a>
            </div>
        @endforeach
    </div>
</div>
<script type="text/javascript">
$$(".desc").each( function(link) {
    new Tooltip(link, {
        mouseFollow: false
    });
});
</script>
