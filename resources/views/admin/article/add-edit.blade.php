@extends('admin.layouts.app')

@section('page-title', 'Articles')
@section('page-heading', 'Articles')

@section ('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{route('article.index')}}">Articles</a>
    </li>
@stop

@section('content')

    @include('admin.partials.messages')



    <div class="card">
        <div class="card-body" style="padding: 5px 0px !important;">
		<form name="embedvideo" id="embedvideo" enctype="multipart/form-data" >
									<input type="file" name="mediafile" style="display:none" id="mediafile">
									@csrf
			</form>
		
            <form action="{{$edit?route('article.store',[$article->id]):route('article.store')}}" style="padding-left: 15px;" method="POST" id="add-edit-article" class="pb-2 mb-3 border-bottom-light">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-md-2">
                    @include('admin/article/partials/add_left_column',[$edit,($edit?$article:[]),$headTags,$tags])
                </div>
                <div class="col-md-10">
                    @include("admin/article/partials/main_tab",[$edit])
                    @include("admin/article/partials/tab_main_info",[$edit,($edit?$article:[]),$headTags,$tags])
                    @include("admin/article/partials/tab_gallery",[$edit,($edit?$article:[]),$fileRepo])
                    @include("admin/article/partials/tab_attachment",[$edit,($edit?$article:[])])
                    <input type="hidden" id="article_id" value="{{$edit?$article->id:0}}">
                    <div class="row" style="background: #CDCDCD;padding-bottom: 10px;margin-top: 10px;">
                        <div class="col-md-12" style="text-align: right; padding-top: 10px; padding-right: 40px;"><button type="submit" class="btn btn-primary">Save & continue edit</button></div>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
    <div id="apply_tags" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:80%;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="display: block !important;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="float: left;">Apply Tags</h4>
                </div>
                <div class="modal-body" style="height: 200px !important;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    @include("admin/file/modal_poup")
@stop
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/assets/datetimepicker-master/jquery.datetimepicker.css') }}">
@stop
@section('scripts')
    <script src="{{asset("admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.js")}}"></script>
    <script src="{{asset('admin/assets/datetimepicker-master/jquery.datetimepicker.js')}}"></script>

    <script  src="{{asset("/admin/assets/js/tiny_mce/tiny_mce.js")}}"></script>

    <script>
        var _cdn_url = "{{Config::get('app.cdn_url')}}";
        var articleTiny = tinyMCE.init({
            mode: "exact",
            elements: "body_article",
            theme: "advanced",
            plugins: "advimage,filepicker,media,inlinepopups,fullscreen",
            theme_advanced_buttons1: "bold,italic,underline,striketrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,styleselect,formatselect,fontselect,fontsizeselect,separator,removeformat,cleanup",
            theme_advanced_buttons2: "cut,copy,paste,separator,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,anchor,separator,forecolor,backcolor,separator,image,filepicker,media,separator,code,separator,fullscreen",
            theme_advanced_buttons3: "",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_path_location: "bottom",
            plugin_insertdate_dateFormat: "%Y-%m-%d",
            plugin_insertdate_timeFormat: "%H:%M:%S",
            theme_advanced_resize_horizontal: false,
            theme_advanced_resizing: true,
            extended_valid_elements: "a[name|href|target|title|onclick|rel],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|obj|param|embed|style],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],object[classid|width|height|codebase|*],param[name|value|_value],embed[type|width|height|src|*]",
            content_css: "{{asset('/admin/assets/css/article_styles.css')}}",
            theme_advanced_styles: "Highlight right=quote_right;Highlight left=quote_left;Image right=right_image;Image left=left_image",
            relative_urls: false, // Default value
            document_base_url: "{{\Illuminate\Support\Facades\Config::get('app.url')}}",
            convert_urls: false,
            fullscreen_new_window: false,
            height: "480",
            fullscreen_settings: {theme_advanced_path_location: "top"},
            setup: function (ed) {
                "adminArticle" in window && ed.onChange.add(adminArticle.onContentChange.bind(adminArticle));
            }
        });
        $('#created').datetimepicker({
            format: 'M d, Y g:i A',
            formatTime: 'g:i A',
            step: 5,

        });
        $('.left-nav-tabs li a').click(function () {
            var arrTab = ['tab_sefriendly', 'tab_options'];
            processTabs(this, arrTab, "left-nav-tabs");
        });
        $('.main-nav-tabs li a').click(function () {
            var arrTab = ['tab_main_info', 'tab_gallery', 'tab_attachments'];
            processTabs(this, arrTab, "main-nav-tabs");
        });
        /*Process select tag*/
        var currentSelectTagId = Array();

        @if($edit && $tags)
        <?php
        $arrIndex = [];
        foreach ($tags as $tag) {
            if(isset($headTags[$tag->id])) {
                continue;
            }
            if (!isset($arrIndex[$tag->group_id])) {
                $arrIndex[$tag->group_id] = 0;
                echo 'currentSelectTagId[' . $tag->group_id . ']=Array();' . "\n";
            }
            echo 'currentSelectTagId[' . $tag->group_id . '][' . $arrIndex[$tag->group_id] . ']=' . $tag->id . ';' . "\n";
            $arrIndex[$tag->group_id]++;
            ?>
            <?php
        }
        ?>
        @endif
        function multipleTag() {
            $(".autocomplete-input input").autocomplete({
                html: true,
                source: function (request, response) {
                    var _keyword = $(".autocomplete-input input").val();
                    $('.autocomplete-input .loader').show();
                    $.getJSON('{{route('article.searchTag')}}' + '?article=1&keyword=' + _keyword, function (data) {
                        var isNew = true;
                        var array = !data ? [] : $.map(data, function (m) {
                            if (_keyword.toLowerCase() == m.name.toLowerCase()) {
                                isNew = false;
                            }
                            return {
                                label: m.name,
                                value: m.id,
                                group: m.group,
                                group_id: m.group_id
                            };
                        });
                        if (isNew) {
                            var arrAdd = [{label: _keyword, value: 'add', group: "Add Keywords", group_id: 0}];
                            if (array.length > 0) {
                                for (var i in array) {
                                    arrAdd.push(array[i]);
                                }
                            }
                            array = arrAdd;
                        }
                        $('.autocomplete-input .loader').hide();
                        response(array);

                    });
                },
                select: function (event, ui) {
                    if (ui.item.value == 'add') {
                        $('.autocomplete-input .loader').show();
                        $.ajax({
                            type: "POST",
                            url: "{{route('tag.quickCreate')}}",
                            data: ui.item,
                            success: function (data) {
                                $('.autocomplete-input .loader').hide();
                                if (data.error != undefined) {
                                    $('#result_apply_tags').css('color', 'red');
                                    $('#result_apply_tags').html("Error: tag is not created!");
                                } else {
                                    tagSelected(data);
                                }
                            }
                        });

                    } else {
                        tagSelected(ui.item);
                    }
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                if (item == null || item == undefined || item.group == undefined) {
                    return $('<li>').append('').appendTo(ul);
                }
                var item = $('<div class="list_item_container"><b>' + item.group + '</b> ' + item.label + '</div>');
                return $("<li>").append(item).appendTo(ul);
            };
        }

        function tagSelected(_obj) {
            if (_obj == undefined || _obj == null) {
                return false;
            }
            if (currentSelectTagId.length == 0 || currentSelectTagId[_obj.group_id] === undefined || currentSelectTagId[_obj.group_id].length == 0 || currentSelectTagId[_obj.group_id].includes(_obj.value) === false) {
                if (currentSelectTagId.length == 0 || currentSelectTagId[_obj.group_id] === undefined) {
                    currentSelectTagId[_obj.group_id] = Array();
                }
                currentSelectTagId[_obj.group_id].push(_obj.value);
                parseTagArray(currentSelectTagId);
                $('#search_tag_input').before('<li class="bit bit-box"><span class="category">' + _obj.group + '</span> ' + _obj.label + '<a href="javascript:;" class="closebutton del-tags" onclick="delSelectTag(this)" data-id="' + _obj.value + '" group-id="' + _obj.group_id + '"></a></li>');
                $('.autocomplete-input input').val('');
                $('.autocomplete-input input').focus();
            }
        }

        /**delete select tag**/
        function delSelectTag(obj) {
            var tagId = $(obj).attr('data-id');
            var groupId = $(obj).attr('group-id');
            if (tagId && groupId) {
                $(obj).parent().remove();
                currentSelectTagId[groupId] = currentSelectTagId[groupId].filter(function (e) {
                    return e != tagId
                });
                parseTagArray(currentSelectTagId);
            }
        }

        function parseTagArray(tagArray) {
            var listId = '';
            var totalTag = tagArray.length;
            if (totalTag > 0) {
                for (var _key in tagArray) {
                    for (var _child in tagArray[_key]) {
                        listId += _key + ':' + tagArray[_key][_child] + ',';
                    }
                }
            }
            $('input[name=tags_id]').val(listId);
        }

        multipleTag();

    </script>
    @yield("script_modal")
    <script>
        /** select image **/
        var _currentType = null;
        var selectImageId = null;
        /** insert image **/
		
		/********* Upload Media ***********/
		 $('.insert_media').on('click',function(e){
			  //tinymce.activeEditor.execCommand('mceMedia');
					 
			  e.preventDefault();
			  $("#mediafile").trigger('click');
		 });
		 $("#mediafile").on('change',function(){
			    $("#videoresult").html('');
			    var val = $(this).val().toLowerCase(),
                regex = new RegExp("(.*?)\.(mp4)$");
				if (!(regex.test(val))) {
					$(this).val('');
					alert('Only mp4 file allowed');
					return false;
				}
				 $("form#embedvideo").submit();  
		 });
		 $("form#embedvideo").submit(function(e) {
		
			e.preventDefault();    
			var formData = new FormData(this);
			$.ajax({
				url: "<?php echo route('uploadmedia')?>",
				type: 'POST',
				data: formData,
				beforeSend: function () {
					$(".insert_media").text('Uploading..');
				   
				},
				success: function (data) {
					  $(".insert_media").text('Upload Video');
					  $('#embedvideo')[0].reset();
					 
					  $html = '<input type="text" value="'+data+'">&nbsp;<a href="javascript::void(1);" class="copylink btn btn-primary" data-src="'+data +'">Copy Link</a>';
					  $("#videoresult").html($html);
					  
					 
					/*tinymce.activeEditor.execCommand('mceMedia');
					document.getElementById('src').value='ok';
					$content = '<p><video width="320" height="240" data-videojs="yes" data-fluid="no" data-videoads="yes" preload="auto" data-videoautoplay="yes"  src="'+data+'"></video></p>'
		             //tinyMCE.activeEditor.execCommand('mceInsertRawHTML',false,$content);*/
				   
				},
				
				contentType: false,
				processData: false
			});
		
	     });
		 $('.pickvideo').on('click',function(){
			    $('#myModal').modal('show');
			    $.ajax({
				url: "<?php echo route('pickvideo')?>",
				type: 'GET',
				success: function (data) {
					  
				   $("#videolist").html(data);
				    
				}
				
			    });
		 });
		 $(document).delegate('.copylink','click',function(){
              $link = $(this).attr('data-src');
			  var $temp = $("<input>");
			  $("body").append($temp);
			  $temp.val($link).select();
			  document.execCommand("copy");
			  $temp.remove();
			  alert('Link Copied');
			  return false;
		
	     });
		
		
		/***********************************/
		
		
		
        $('#poup_select_image').click(function () {
            selectImageId = 'image';
            if ($("#popup_file_modal .list-folder").html() == '' || _currentType != 1) {
                getListFolder(1);
                _currentType = 1;
                $("#modal_loading").modal('toggle');
            } else {
                $('#popup_file_modal').modal(true);
            }
        });
        /** add gallery action **/
        $('#add_gallery').click(function () {
            selectImageId = 'list_gallery_image';
            if ($("#popup_file_modal .list-folder").html() == '' || _currentType != 1) {
                getListFolder(1);
                _currentType = 1;
                $("#modal_loading").modal('toggle');
            } else {
                $('#popup_file_modal').modal(true);
            }
        });
        /** add attachment **/
        $('#add_attachment').click(function () {
            selectImageId = 'multiple_attachments_holder';
            if ($("#popup_file_modal .list-folder").html() == '' || _currentType != 0) {
                getListFolder(0);
                _currentType = 0;
                $("#modal_loading").modal('toggle');
            } else {
                $('#popup_file_modal').modal(true);
            }
        });
        /** article files **/
        @if($edit)
            var article_file_id = 0,article_select_type="";
            $(".content-page").on("dblclick", ".article-files", function () {
                console.log("selectImageId",selectImageId);
                var _title = $(this).attr('data-title');
                var _des = $(this).attr('data-des');
                var _type = $(this).attr("data-type");
                article_select_type = _type;
                if (_type == 'list_gallery_image') {
                    $("#list_gallery_image span.article-files").removeClass('selected');
                    $('#gallery_title').val(_title);
                    $('#gallery_description').val(_des);
                } else {
                    $("#multiple_attachments_holder div.article-files").removeClass('selected');
                    $('#attachment_title').val(_title);
                    $('#attachment_description').val(_des);
                }
                article_file_id = $(this).attr('data-id');
                $(this).addClass('selected');
            });

            $(".content-page").on("click", ".apply-article-files", function () {
                var _title = "",_des = "";
                var _tagName = 'span';
                if (article_select_type == 'list_gallery_image') {
                    _title = $('#gallery_title').val();
                    _des = $('#gallery_description').val();
                } else {
                    _title = $('#attachment_title').val();
                    _des = $('#attachment_description').val();
                    _tagName = 'div';
                }
                if(!_title && !_des) {
                    alert("Error: You have to fill Title or Description.");
                    return false;
                }
                var _obj = this;
                $(this).hide();
                $("#apply-loading-"+article_select_type).show();
                $.ajax({
                    type: "POST",
                    url: "{{route('article.applyFile')}}",
                    data: {_token:$('meta[name=csrf-token]').attr('content'),'file_id':article_file_id,select_type:article_select_type,description:_des,title:_title},
                    success: function (data) {
                        var _bgColor = 'blue';
                        if(data.error == 0) {
                            $("#" + article_select_type).find(_tagName + ".article-files[data-id="+article_file_id+"]").attr("data-title",_title);
                            $("#" + article_select_type).find(_tagName + ".article-files[data-id="+article_file_id+"]").attr("data-des",_des);
                        } else {
                            _bgColor = 'red';
                        }
                        $("#apply-" + article_select_type + ' div').html(data.message);
                        $("#apply-" + article_select_type).css("background",_bgColor);
                        $("#apply-" + article_select_type).show();
                        setTimeout(function(){ $("#apply-" + article_select_type).hide(500); }, 3000);
                        $(_obj).show();
                        $("#apply-loading-"+article_select_type).hide();
                    }
                });
            });
        // sort article
        $('#list_gallery_image').sortable({
            update: function (event, ui) {
                var _listId = Array();
                $('#list_gallery_image .article-files').each(function() {
                    _listId.push($(this).attr('data-id'));
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('article.sortFile')}}",
                    data: {listId:_listId,_token:$('meta[name=csrf-token]').attr('content'),article_id:{{$article->id}},type:'gallery'},
                    success: function (data) {
                        noticeArticleFile(data,'list_gallery_image');
                    }
                });
            }
        });
        $('#multiple_attachments_holder').sortable({
            update: function (event, ui) {
                var _listId = Array();
                $('#multiple_attachments_holder .article-files').each(function() {
                    _listId.push($(this).attr('data-id'));
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('article.sortFile')}}",
                    data: {listId:_listId,_token:$('meta[name=csrf-token]').attr('content'),article_id:{{$article->id}},type:'attachment'},
                    success: function (data) {
                        noticeArticleFile(data,'list_gallery_image');
                    }
                });
            }
        });
        $(".content-page").on("click", ".delete-article-files", function () {
            var _id = $(this).attr('data-id');
            var _type = $(this).attr('data-type');
            var _obj = this;
            $.ajax({
                type: "POST",
                url: "{{route('article.delFile')}}",
                data: {_token:$('meta[name=csrf-token]').attr('content'),id:_id,select_type:_type},
                success: function (data) {
                    if(data.error == 0) {
                        if(_type == 'list_gallery_image') {
                            $("#list_gallery_image").find("span.article-files[data-id="+_id+"]").remove();
                        } else {
                            $("#multiple_attachments_holder").find("div.article-files[data-id="+_id+"]").remove();
                        }

                    }
                    noticeArticleFile(data,_type);
                }
            });
        });
        function noticeArticleFile(data,_type) {
            var _bgColor = 'blue';
            if(data.error == 1){
                _bgColor = 'red';
            }
            $("#notice-" + _type + ' div').html(data.message);
            $("#notice-" + _type).css("background",_bgColor);
            $("#notice-" + _type).show();
            setTimeout(function(){ $("#notice-" + _type).hide(500); }, 3000);
        }
        @endif

    </script>
@stop


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" style="
    position: absolute;right: 10px;">&times;</button>
        <h4 class="modal-title">Copy Video Link</h4>
      </div>
      <div class="modal-body col-md-12" id="videolist">
           <p style="text-align:center">Loading..</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>