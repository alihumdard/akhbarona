<div class="row" id="body_browser_list_file">
    <div class="col-md-3 list-folder">
        @include('admin.file.include.list_folder',[$fileConfig,$childFolders])
    </div>
    <div class="col-md-9">
        <div class="row" style="padding-bottom: 10px;">
            <div class="col-md-3 file-view">
                <div class="row">
                    <div class="col-md-4">
                        <span>View:</span>
                    </div>
                    <div class="col-md-4 file-view-grid">
                        <a href="javascript:;" class="selected"></a>
                    </div>
                    <div class="col-md-4 file-view-list">
                        <a href="javascript:;"></a>
                    </div>
                </div>

            </div>
            <div class="col-md-9 search-popup-file">
                <div class="row">
                    <div class="col-md-3" style="text-align: right">
                        <label>Search:</label>
                    </div>
                    <div class="col-md-6"><input type="text" class="custom-form-control" style="width: 100%;height: 30px; margin-top: 0px;" id="search_popup_file"></div>
                    <div class="col-md-3"><button type="button" id="btn_search_popup_file">Search</button></div>
                </div>
            </div>
        </div>
        <div class="list-file">
            @include('admin.file.include.browse',[$files,$fileType,$isMultiple])
        </div>

    </div>
</div>
<div class="row" id="upload_file_computer" style="display: none;">
    <form enctype="multipart/form-data" id="form_upload_file_popup" action="">
        <div class="col-md-12">
        <div class="form-group">
            <label class="label-default" for="upload_dest_file" style="text-align: right;">Upload destination</label>
            <select name="upload_dest_file" id="upload_dest_file" class="form-control">
                <option value="">Choose destination</option>
                <option value="{{$fileConfig}}">{{$fileConfig}}</option>
                @foreach($childFolders as $i =>$folder)
                    <option{{$i == 0?' selected="selected"':''}} value="{{$folder->path.$folder->name}}">{{$folder->path.$folder->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="label-default" for="upload_dest_file" style="text-align: right;">Select File</label>
            <input type="file" name="upload_file_popup" class="form-control" @if($fileType == 1 || $fileType == 100) accept="image/*" @endif>
        </div>
        <div class="form-group">
            <button type="button" id="btn_upload_file_popup">Upload</button>
        </div>

    </div>
    </form>
    <div id="loading_upload_popup" style="display: none;justify-content: center;align-items: center;margin-top: 6%;margin-left: 40%;"><img src="{{asset('/admin/assets/img/uploading.gif')}}"></div>
</div>
<script>
    var fileType = {{$fileType}};
    $('.file-view a').click(function () {
        var isGrid = $(this).parent().hasClass('file-view-grid');
        if(isGrid) {
            $('.file-view .file-view-list a').removeClass('selected');
            $('#browse_file_grid').show();
            $('#browse_file_list').hide();
        } else {
            $('.file-view .file-view-grid a').removeClass('selected');
            $('#browse_file_grid').hide();
            $('#browse_file_list').show();
        }
        $(this).addClass('selected');
    });
    $('#popup_file_modal li .select-folder').click(function () {
        var _path = $(this).attr("data-folder");
        $("#popup_file_modal li .select-folder").removeClass('selected');
        objFolderIcons = $("#popup_file_modal li .select-folder i");
        objFolderIcons.each(function (index) {
            if($(this).hasClass("fa-folder-open")) {
                $(this).addClass("fa-folder");
                $(this).removeClass("fa-folder-open");
            }
        });
        $(this).find('i').addClass("fa-folder-open");
        $(this).find('i').removeClass('fa-folder');
        $(this).addClass('selected');
        var _objFilter = {_token:$('meta[name=csrf-token]').attr('content'),type_file:{{$fileType}},is_multiple:{{$isMultiple}},path:_path,only_file:1};
        ajaxGetListFiles(_objFilter);
    });
    $('#btn_search_popup_file').click(function () {
        var keyword = $('#search_popup_file').val().trim();
        if(!keyword) {
            alert("Error: You don't input any keyword!")
        } else {
            var _objFilter = {_token:$('meta[name=csrf-token]').attr('content'),type_file:{{$fileType}},is_multiple:{{$isMultiple}},keyword:keyword,only_file:1};
            ajaxGetListFiles(_objFilter);
        }
    });
    function ajaxGetListFiles(objFilter) {

        $('#popup_file_modal .modal-body .list-file').html('<div style="display: flex;justify-content: center;align-items: center;margin-top:120px;"><img src="{{asset('admin/assets/img/loading.gif')}}"></div>');
        $.ajax({
            type: "POST",
            url: "{{route('file.ajaxDirectory')}}",
            data: objFilter,
            success: function (data) {
                $('#popup_file_modal .modal-body .list-file').html(data);
            }
        });
    }
    $("#popup_file_modal .popup-file-nav-tabs li a").click(function () {
        var arrTab = ['body_browser_list_file','upload_file_computer'];
        processTabs(this,arrTab,"popup-file-nav-tabs");
    });
    $("#btn_upload_file_popup").click(function () {
        _path = $('#upload_dest_file').val();
        if(_path == '') {
            alert("Error: You don't Choose destination! ");
            return false;
        }
        var fd = new FormData();
        var files = $('input[name=upload_file_popup]')[0].files[0];
        if(!files) {
            alert("Error: You don't Choose file! ");
            return false;
        }
        fd.append('file',files);
        fd.append('_token',$('meta[name=csrf-token]').attr('content'));
        fd.append('select_type',selectImageId);
        fd.append('article_id',$('#article_id').val());
        fd.append('path',_path);
        @if($fileType)
            fd.append('file_type',{{$fileType}});
        @endif
        $("#loading_upload_popup").show();
        $("#form_upload_file_popup").hide();
        $.ajax({
            url: '{{route('file.upload')}}',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response.error == 0){
                    selectImageName = response.data;
                    console.log("isMultiple",isMultiple);
                    if(isMultiple != 1 && selectImageName) {
                        if(fileType == 100) {
                            tinyMCE.activeEditor.execCommand('mceInsertContent', false,'<img class="__mce_image" data-mce-src="'+_cdn_url+selectImageName+'" src="'+_cdn_url+selectImageName+'">');
                            $('#popup_file_modal .close').click();
                        } else {
                            selectImageName = selectImageName.replace("{{$fileConfig}}/","");
                            $("#" + selectImageId).val(selectImageName);
                        }
                    } else if(isMultiple == 1) {
                        if(selectImageId == 'list_gallery_image') {
                            $('#list_gallery_image').html(response.data);
                        } else {
                            $('#multiple_attachments_holder').html(response.data);
                        }
                    }
                    $("#popup_file_modal .list-folder").html('');
                    $("input[name=upload_file_popup]").val('');
                    $('#popup_file_modal .close').click();
                    $(".popup-file-nav-tabs").find('a[data-id=body_browser_list_file]').click();
                }else{
                    alert(response.data);
                }
                $("#loading_upload_popup").hide();
                $("#form_upload_file_popup").show();
            },
        });
    });
</script>
