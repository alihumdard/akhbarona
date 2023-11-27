
<div id="browse_file_grid">
    <?php $j = 0;$totalFile = count($files);?>
    <?php if($totalFile  > 0) {?>

        <?php foreach ($files as $file) { ?>
            <?php if($j==0) { ?>
            <div class="row">
            <?php } ?>
                <div class="col-md-3 thumb_preview">
                    <div class="img_container select-file" data-id="{{$file->id}}" data-file="{{$file->path.$file->name.'.'.$file->extension}}" data-multiple="{{$isMultiple}}">
                        <div class="img_wrapper">
                            <img title="<strong>Name: </strong>{{$file->name.'.'.$file->extension}} </br><strong>Size: </strong>{{\App\Helper\Common::convertSize($file->size)}} ({{$file->width.'px '.$file->height.'px'}})</br><strong>Date: </strong>{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$file->mtime)->format('d/m/Y H:i A T')}}" src="<?=$file->filetype_id == 1?$fileRepo->getThumbview(str_replace(Config::get('site.files').'/','',$file->path.$file->name.'.'.$file->extension)):"/admin/assets/img/mime_".$file->extension.".gif";?>">
                        </div>
                    </div>
                </div>
             <?php $j++;?>
            <?php if($j > 0 && $j%4 == 0) { ?>
            </div>
                <?php if($j < ($totalFile -1)) { ?>
                    <div class="row">
                <?php } ?>
            <?php }?>
        <?php } ?>
            <?php if($totalFile%4 != 0) {?>
                    </div>
            <?php } ?>
    <?php } ?>
</div>
<div class="row" id="browse_file_list" style="display: none;">
    <div class="col-md-12">
        <ul>
            @if($totalFile > 0)
                @foreach($files as $j =>$file)
                    <li class="select-file {{'mime_'.strtolower($file->extension)}} row_{{$j%2}}" title="<strong>Name: </strong>{{$file->name.'.'.$file->extension}} </br><strong>Size: </strong>{{\App\Helper\Common::convertSize($file->size)}} ({{$file->width.'px '.$file->height.'px'}})</br><strong>Date: </strong>{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$file->mtime)->format('d/m/Y H:i A T')}}" href="javascript:;" data-id="{{$file->id}}" data-file="{{$file->path.$file->name.'.'.$file->extension}}" data-multiple="{{$isMultiple}}">
                        {{$file->name.'.'.$file->extension}}
                    </li>
                @endforeach
            @else
                <li>Don't have any files</li>
            @endif
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-6" id="loading-insert-file" style="display: none;">
        <img src="{{asset('admin/assets/img/loading_bar.gif')}}">
    </div>
    <div class="col-md-6" id="action-insert-file">
        <button type="button" id="insert_file_popup">Insert {{($fileType == 1 || $fileType == 100)?'image':'attachment'}}</button>&nbsp;
        <button type="button" data-dismiss="modal">Cancel</button>
    </div>
    <div class="col-md-6" style="text-align: right">
        <?=$files->links()?>
    </div>
</div>
<script>
    var selectImageName = '';
    var arrListFileId = Array();
    var isMultiple = {{$isMultiple}};
    $("#popup_file_modal .select-file").click(function () {
        selectImage(this,1);
    });
    $("#popup_file_modal .select-file").dblclick(function () {
        selectImage(this,2);
    });
    function selectImage(_obj,_click) {
        isMultiple = $(_obj).attr('data-multiple');
        var fileId = $(_obj).attr('data-id');
        var fileName = $(_obj).attr('data-file');
        if($(_obj).hasClass('selected') && _click == 1) {
            if(isMultiple == 1) {
                arrListFileId = arrListFileId.filter(function (e) {
                    return e != fileId;
                });
            } else {
                selectImageName = '';
            }
            $(_obj).removeClass('selected')
        } else {
            if(isMultiple == 1) {
                arrListFileId.push(fileId);
                $(_obj).addClass('selected');
            } else {
                $("#popup_file_modal .select-file").removeClass('selected');
                selectImageName = fileName;
                $(_obj).addClass('selected');
            }

        }
        if(_click == 2 && isMultiple == 0) {
            $("#insert_file_popup").click();
        }
        console.log('arrListFileId:',arrListFileId);

    }
    $("#popup_file_modal .page-item a").click(function () {
        var _url = $(this).attr('href');
        if(_url) {
            $('#popup_file_modal .modal-body .list-file').html('<div style="display: flex;justify-content: center;align-items: center;margin-top:120px;"><img src="{{asset('admin/assets/img/loading.gif')}}"></div>');
            var _data = {};
            _data["_token"] = "{{csrf_token()}}";
            _data["only_file"] = 1;
            @foreach($arrFilter as $key=>$val)
                _data["{{$key}}"] = "{{$val}}";
            @endforeach
            $.ajax({
                type: "POST",
                url: _url,
                data: _data,
                success: function (data) {
                    $('#popup_file_modal .modal-body .list-file').html(data);
                }
            });
        }
        return false;
    });
    $("#insert_file_popup").click(function () {
        if(isMultiple != 1 && selectImageName) {
            if(fileType == 100) {
                tinyMCE.activeEditor.execCommand('mceInsertContent', false,'<img class="__mce_image" data-mce-src="'+_cdn_url+selectImageName+'" src="'+_cdn_url+selectImageName+'">');
                $('#popup_file_modal .close').click();
            } else {
                selectImageName = selectImageName.replace("{{$fileConfig}}/","");
                $("#" + selectImageId).val(selectImageName);
                $('#popup_file_modal .close').click();
            }

        } else if(isMultiple == 1) {
            if(arrListFileId.length == 0) {
                alert(selectImageId == 'list_gallery_image'?"Error: You don't select any images!":"Error: You don't select any files!");
            }
            var articleId = $("#article_id").val();
            if(articleId) {
                $.ajax({
                    type: "POST",
                    url: "{{route('article.gallery')}}",
                    data: {ids:arrListFileId,_token:$('meta[name=csrf-token]').attr('content'),article_id:articleId,select_type:selectImageId},
                    success: function (data) {
                        if(selectImageId == 'list_gallery_image') {
                            $('#list_gallery_image').html(data);
                        } else {
                            $('#multiple_attachments_holder').html(data);
                        }
                        $('#popup_file_modal .close').click();
                        $("#loading-insert-file").hide();
                        $("#action-insert-file").show();
                    }
                });
            }
        }
    });


</script>
