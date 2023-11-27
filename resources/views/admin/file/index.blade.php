@extends('admin.layouts.app')

@section('page-title', 'Files')
@section('page-heading', 'Files')

@section ('breadcrumbs')
    <li class="breadcrumb-item active">
        Files
    </li>
@stop

@section('content')

    @include('admin.partials.messages')



    <div class="card">
        <div class="card-body" style="padding: 5px 0px !important;">
            <div class="row">
                <div class="col-md-3">
                    <div class="container" style="margin-bottom: 20px;">
                        <ul class="nav nav-tabs quick-nav-tabs">

                            <li class="active"><a href="javascript:;" data-id="tab_search">Search</a></li>
                            <li><a href="javascript:;" data-id="tab_upload">Upload file(s)</a></li>
                        </ul>
                    </div>
                    <div id="tab_search">
                        <form action="" style="padding-left: 8px;" method="GET" id="file-search-form" class="pb-2 mb-3 border-bottom-light">

                            <input type="hidden" name="per_page" value="{{$perPage}}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keyword">File Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{isset($_GET['name'])?$_GET['name']:''}}" placeholder="Search file name">
                                    </div>
                                    <div class="form-group">
                                        <label for="path">Search in folder</label>
                                        <select name="path" class="form-control">
                                            <option value="">Folders</option>
                                            @foreach($folders as $folder)
                                                <option value="{{$folder->path.$folder->name.'/'}}" @if(isset($_GET['path']) && $_GET['path'] == $folder->path.$folder->name.'/') selected="selected" @endif>{{$folder->path.$folder->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="extension">Extension</label>
                                        <select name="extension" class="form-control">
                                            <option value="">Extensions</option>
                                            @foreach($extensions as $key=>$vl)
                                                <option value="{{$vl}}" @if(isset($_GET['extension']) && $_GET['extension'] == $vl) selected="selected" @endif>{{$vl}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="padding-top: 10px;">
                                        <button type="submit" class="btn btn-success">Search now</button> &nbsp; <a href="{{route('file.index')}}">clear search</a>
                                    </div>
                                </div>
                            </div>



                        </form>
                    </div>
                    <div id="tab_upload" style="display: none;">
                        <form enctype="multipart/form-data" id="form_upload_file_popup" action="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="label-default" for="upload_dest_file" style="text-align: right;">Upload destination</label>
                                    <select name="upload_dest_file" id="upload_dest_file" class="form-control">
                                        <option value="">Choose destination</option>

                                        @foreach($folders as $i =>$folder)
                                            <option{{$i == 0?' selected="selected"':''}} value="{{$folder->path.$folder->name}}">{{$folder->path.$folder->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="label-default" for="upload_dest_file" style="text-align: right;">Select File</label>
                                    <input type="file" name="upload_file_popup" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="button" id="btn_upload_file_popup">Upload</button>
                                </div>

                            </div>
                        </form>
                        <div id="loading_upload_popup" style="display: none;justify-content: center;align-items: center;margin-top: 6%;margin-left: 40%;"><img src="{{asset('/admin/assets/img/uploading.gif')}}"></div>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row" style="padding-top: 15px;padding-bottom: 20px;">
                        <div class="col-md-4">
                            <div class="row">&nbsp;
                                <div class="col-md-6">
                                    Items per page: <select name="per_page" class="quickSelect">
                                        @foreach([10,30,50] as $key=>$vl)
                                            <option value="{{$vl}}" @if((isset($_GET['per_page']) && $_GET['per_page'] == $vl)) selected="selected" @endif>{{$vl}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 file-view-new">
                                    <a href="javascript:;" class="selected" data-id="browse_file_list"><i class="file-view-list" style="margin-top: 3px;"></i></a>
                                </div>
                                <div class="col-md-2 file-view-new">
                                    <a href="javascript:;" class="" data-id="browse_file_grid"><i class="file-view-grid" style="margin-top: 3px;"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="text-align: right;">
                            <?php $total = $files->total(); $toTotal = $files->currentPage()*$files->perPage();?>
                            {{(($files->currentPage()-1)*$files->perPage())+1}} - {{$toTotal > $total?$total:$toTotal}} of {{$total}}
                        </div>
                        <div class="col-md-6">
                            {!! $files->render() !!}
                        </div>
                    </div>
                    <div class="browse-file" id="browse_file_list">
                        <table class="table table-striped table-borderless">

                            <tbody>
                            @if (count($files))
                                <?php $arrColorStatus = [0=>'btn-dark',1=>'btn-success',-1=>'btn-warning',-2=>'btn-danger']?>
                                @foreach ($files as $file)
                                    <tr>
                                        <td style="width: 40px;">
                                            <div class="{{'mime_'.strtolower($file->extension)}}" style="height: 30px;
    background-position: 0 6px;
    background-repeat: no-repeat;
    padding: 4px 0px 4px 18px;">

                                            </div>

                                        </td>

                                        <td>
                                            <a title="<strong>Name: </strong>{{$file->name.'.'.$file->extension}} </br><strong>Size: </strong>{{\App\Helper\Common::convertSize($file->size)}} ({{$file->width.'px '.$file->height.'px'}})</br><strong>Date: </strong>{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$file->mtime)->format('d/m/Y H:i A T')}}" href="/{{$file->path.$file->name.'.'.$file->extension}}" target="_blank">{{$file->name.'.'.$file->extension}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route("file.download",[$file])}}"><i class="fa fa-download"></i></a> &nbsp;
                                            <a href="javascript:;" data-url="{{route('file.del',[$file])}}" class="delFile" data-name="{{$file->name.'.'.$file->extension}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3"><em>@lang('app.no_records_found')</em></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="browse-file" id="browse_file_grid" style="display: none;">
                        <?php $j = 0;$totalFile = count($files);?>
                        <?php if($totalFile  > 0) {?>

                        <?php foreach ($files as $file) { ?>
                        <?php if($j==0) { ?>
                        <div class="row" style="padding-left: 5px;padding-right: 15px;">
                            <?php } ?>
                            <div class="col-md-2 thumb_preview-manage-file">
                                <div class="img_container" data-id="{{$file->id}}" data-file="{{$file->path.$file->name.'.'.$file->extension}}">
                                    <div class="img_wrapper">
                                        <a href="/{{$file->path.$file->name.'.'.$file->extension}}" target="_blank"><img title="<strong>Name: </strong>{{$file->name.'.'.$file->extension}} </br><strong>Size: </strong>{{\App\Helper\Common::convertSize($file->size)}} ({{$file->width.'px '.$file->height.'px'}})</br><strong>Date: </strong>{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$file->mtime)->format('d/m/Y H:i A T')}}" src="<?=$file->filetype_id == 1?$fileRepo->getThumbview(str_replace(Config::get('site.files').'/','',$file->path.$file->name.'.'.$file->extension)):"/admin/assets/img/mime_".$file->extension.".gif";?>"></a>
                                        <div class="thumb_actions">
                                            <?php if($file->filetype_id == 1) {?>
                                            <a href="javascript:;" class="{{'mime_'.strtolower($file->extension)}}" style="height: 30px;
    background-position: 0 6px;
    background-repeat: no-repeat;
    padding: 4px 0px 4px 18px;"></a>&nbsp;
                                                <?php } ?>
                                            <a href="{{route("file.download",[$file])}}"><i class="fa fa-download"></i></a> &nbsp;
                                            <a href="javascript:;" data-url="{{route('file.del',[$file])}}" class="delFile" data-name="{{$file->name.'.'.$file->extension}}"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $j++;?>
                            <?php if($j > 0 && $j%6 == 0) { ?>
                        </div>
                        <?php if($j < ($totalFile -1)) { ?>
                        <div class="row" style="padding-left: 5px;padding-right: 15px;">
                            <?php } ?>
                            <?php }?>
                            <?php } ?>
                            <?php if($totalFile%6 != 0) {?>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    {!! $files->render() !!}
                </div>
            </div>

        </div>
    </div>
@stop
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.css') }}">
@stop
@section("scripts")
    <script src="{{asset("admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.js")}}"></script>
    <script>
        $('.quick-nav-tabs li a').click(function () {
            var arrTab = ['tab_quicklink', 'tab_search','tab_upload'];

            processTabs(this, arrTab, "quick-nav-tabs");
        });
        $('.quickSelect').change(function () {
            var _name = $(this).attr('name');
            $('#file-search-form').find('input[name='+_name+']').val($(this).val());
            $('#file-search-form').submit();
        });
        $('.delFile').click(function () {
            var _ok = confirm('Do you want delete file "' +$(this).attr('data-name')+ '"');
            if(_ok) {
                _url = $(this).attr('data-url');
                console.log("_url",_url);
                var _obj = this;
                $.ajax({
                    type: "POST",
                    url: _url,
                    data:{_token:$('meta[name=csrf-token]').attr('content')},
                    success: function (data) {
                        alert(data.message);
                        if(data.error == 0) {
                            $(_obj).parent().parent().remove();
                        }

                    }
                });
            }
        });
        $(".file-view-new a").click(function () {
            if(!$(this).hasClass('selected')) {
                $('.file-view-new a').removeClass('selected');
                $(this).addClass('selected');
                $(".browse-file").hide();
                $("#" + $(this).attr("data-id")).show();
            }
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
            fd.append('select_type','');
            fd.append('article_id',0);
            fd.append('path',_path);
            $("#loading_upload_popup").show();
            $("#form_upload_file_popup").hide();
            $.ajax({
                url: '{{route('file.upload')}}',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.error == 1) {
                        alert(response.data);
                    } else {
                        alert("Uploaded is successfully!");
                        $("input[name=upload_file_popup]").val('');
                    }
                    $("#loading_upload_popup").hide();
                    $("#form_upload_file_popup").show();
                },
            });
        });
        $( document ).tooltip({
            content:function(){
                return this.getAttribute("title");
            }
        });
    </script>
@stop
