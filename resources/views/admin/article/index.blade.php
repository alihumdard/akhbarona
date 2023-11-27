@extends('admin.layouts.app')

@section('page-title', 'Articles')
@section('page-heading', 'Articles')

@section ('breadcrumbs')
    <li class="breadcrumb-item active">
        Articles
    </li>
@stop

@section('content')

    @include('admin.partials.messages')



    <div class="card">
        <div class="card-body" style="padding: 5px 0px !important;">
            <div class="row">
                <div class="col-md-2">
                    <div class="container" style="margin-bottom: 20px;">
                        <ul class="nav nav-tabs quick-nav-tabs">
                            <li><a href="javascript:;" data-id="tab_quicklink">Quick Link</a></li>
                            <li class="active"><a href="javascript:;" data-id="tab_search">Search</a></li>
                        </ul>
                    </div>
                    <div id="tab_quicklink" style="padding-left: 8px; display: none;">
                        <p><a href="{{route('article.index')}}">All</a></p>
                        <p><a href="{{route('article.index')}}?status=0">Pending</a></p>
                        <p><a href="{{route('article.index')}}?status=1">Active</a></p>
                        <p><a href="{{route('article.index')}}?status=-1">Archive</a></p>
                        <p><a href="{{route('article.index')}}?status=-2">Trashbin</a></p>
                        <p><strong>Search Filters</strong></p>
                        @if($userFilters)
                            @for($i=0;$i<count($userFilters);$i++)
                                <p>
                                    <a href="{{$userFilters[$i]['url']}}" style="padding-right: 20px;">{{$userFilters[$i]['name']}}</a>
                                    <a href="{{ route('user.delFilter', $userFilters[$i]['id']) }}" class="btn btn-icon"
                                       title="Delete Filter"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('app.please_confirm')"
                                       data-confirm-text="{{trans('Are you sure delete ":name" filter',["name"=>$userFilters[$i]['name']])}}"
                                       data-confirm-delete="@lang('app.yes_delete_it')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </p>
                            @endfor
                        @endif
                    </div>
                    <div id="tab_search">
                        <form action="" style="padding-left: 8px;" method="GET" id="article-search-form" class="pb-2 mb-3 border-bottom-light">

                        <input type="hidden" name="per_page" value="{{$per_page}}">

                        <input type="hidden" name="sort_by" value="{{(isset($_GET['sort_by'])?$_GET['sort_by']:'')}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="keyword">Keyword(s)</label>
                                    <input type="text" name="keyword" id="keyword" class="form-control" value="{{isset($arrFilter['keyword'])?$arrFilter['keyword']:''}}" placeholder="Search keyword">
                                </div>
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" name="author" id="author" value="{{isset($arrFilter['author'])?$arrFilter['author']:''}}" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="search_tag">Tag</label>
                                    <input type="text" id="search_tag" name="tag" value="{{isset($arrFilter['tag'])?$arrFilter['tag']:''}}" class="form-control" placeholder="Search tag">
                                    <input type="hidden" value="{{isset($arrFilter['tag_id'])?$arrFilter['tag_id']:''}}" id="tag_id" name="tag_id">
                                </div>
                                <div class="form-group">
                                    <label for="search_tag">Find posts from</label>
                                    <select name="post_date" class="form-control">
                                        @foreach($dateFilter as $key=>$vl)
                                            <option value="{{$key}}" @if(isset($_GET['post_date']) && $_GET['post_date'] == $key) selected="selected" @endif>{{$vl}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        @foreach($arrStatus as $key=>$vl)
                                            <option value="{{$key}}" @if(isset($_GET['status']) && is_numeric($_GET['status']) && $_GET['status'] == $key) selected="selected" @endif>{{$vl}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="search_cid">Categories (use ctrl for multiple)</label>
                                    <select name="search_cid[]" id="search_cid" class="form-control" multiple="multiple" size="14">
                                        <option value="">All Category</option>
                                        @foreach($categories as $key=>$arr)
                                            <option value="{{$key}}" @if(in_array($key,$arrSearchCid)) selected="selected" @endif>{{$arr['category_name']}}</option>
                                            @if(isset($arr['child']) && count($arr['child']) > 0)
                                                @foreach($arr['child'] as $child)
                                                    <option value="{{$child['id']}}" @if(in_array($child['id'],$arrSearchCid)) selected="selected" @endif>- {{$child['category_name']}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="padding-top: 10px;">
                                    <button type="submit" class="btn btn-success">Search now</button> &nbsp; <a href="{{route('article.index')}}">clear search</a> &nbsp;<a href="{{ route('article.create') }}" class="btn btn-primary btn-rounded desktop-hide">
                                        <i class="fas fa-plus mr-2"></i>
                                        Add Article
                                    </a>
                                </div>
                            </div>
                        </div>



                    </form>
                        <div style="padding-left: 8px;" class="mobile-hide">
                            <p><strong>Search Filters</strong></p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="save_search_filter">Filter Name:</label>
                                        <input type="text" id="save_search_filter">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="btn_save_search_filter">Save Filter</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light mobile-hide">
                        <div class="row my-3 flex-md-row flex-column-reverse">
                            <div class="col-md-4 mt-md-0 mt-2">
                                <div class="input-group custom-search-form">
                                    <select name="select_action" id="select_action" class="form-control" disabled="disabled">
                                        @foreach($selectAction as $key=>$arr)
                                            @if(!isset($arr['label']))
                                                <option value="{{$key}}">{{$arr}}</option>
                                            @else
                                                <optgroup label="{{$arr['label']}}">
                                                @if($key == 'move')
                                                    @foreach($categories as $ctKey=>$cArr)
                                                        <option value="category_id.{{$ctKey}}">{{$cArr['category_name']}}</option>
                                                        @if(isset($cArr['child']))
                                                            @foreach($cArr['child'] as $child)
                                                                <option value="category_id.{{$child['id']}}">- {{$child['category_name']}}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach($arr['child'] as $cKey=>$cVl)
                                                        <option value="{{$cKey}}">{{$cVl}}</option>
                                                    @endforeach
                                                @endif
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 mt-2 mt-md-0">

                            </div>

                            <div class="col-md-6">
                                <div class="float-right">
                                    <a href="{{ route('article.create') }}" class="btn btn-primary btn-rounded">
                                        <i class="fas fa-plus mr-2"></i>
                                        Add Article
                                    </a>
                                </div>
                            </div>

                        </div>
                    </form>


                    <div class="row mobile-hide">
                        <div class="col-md-4">
                            Sort by <select name="sort_by" class="quickSelect">
                                @foreach($arrSort as $key=>$vl)
                                    <option value="{{$key}}" @if((isset($_GET['sort_by']) && $_GET['sort_by'] == $key)) selected="selected" @endif>{{$vl}}</option>
                                    @endforeach
                            </select>
                            &nbsp;
                            Items per page <select name="per_page" class="quickSelect">
                                @foreach([10,30,50] as $key=>$vl)
                                    <option value="{{$vl}}" @if((isset($_GET['per_page']) && $_GET['per_page'] == $vl)) selected="selected" @endif>{{$vl}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" style="text-align: right;">
                            <?php $total = $articles->total(); $toTotal = $articles->currentPage()*$articles->perPage();?>
                            {{(($articles->currentPage()-1)*$articles->perPage())+1}} - {{$toTotal > $total?$total:$toTotal}} of {{$total}}
                        </div>
                        <div class="col-md-6">
                            {!! $articles->render() !!}
                        </div>
                    </div>

                    <div class="table-responsive" id="users-table-wrapper">
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th class="mobile-hide">&nbsp;</th>
                                <th class="mobile-hide">&nbsp;</th>
                                <th class="min-width-100" style="text-align: center;">@lang('app.title')</th>
                                <th class="mobile-hide">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody id="sortListArticle">
                            @if (count($articles))
                                <?php $arrColorStatus = [0=>'btn-dark',1=>'btn-success',-1=>'btn-warning',-2=>'btn-danger']?>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td style="vertical-align:middle;" class="mobile-hide">
                                            @if(!$isPending || $article['user_id'] == Auth::user()->id)
                                                <input style="height: 20px;width: 20px;" type="checkbox" name="article_select[]" class="article-select" value="{{$article->id}}">
                                            @endif
                                        </td>
                                        <td style="vertical-align:middle;" class="mobile-hide">
                                            <a href="javascript:;"><img src="{{asset('admin/assets/img/icons/move-action.png')}}"></a>
                                        </td>
                                        <td style="vertical-align:middle;" class="rtl">
                                            <a class="title" href="@if(!$isPending || $article['user_id'] == Auth::user()->id) {{route('article.edit',[$article])}} @else javascript:; @endif">{{ $article['title'] }}</a>
                                            <p>
                                                <a href="{{route('article.index')}}?author={{$article->author}}">{{$article->author}}</a>
                                                On {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$article->created)->format('d M Y')}}
                                                In <a href="{{route('article.index')}}?search_cid[]={{$article->category_id}}">{{$article->category_name}}</a>
                                                with {{$article->countComment()}} comments and <span style="font-weight: bold;">{{$article->countTag()}} tags</span>
                                            </p>
                                        </td>
                                        <td style="vertical-align:middle;" class="mobile-hide">
                                            @if(isset($arrStatus[$article->status]))
                                            <span class="btn {{$arrColorStatus[$article->status]}}">{{$arrStatus[$article->status]}}</span>
                                            @else
                                                'N/A'
                                            @endif
                                        </td>
                                        <td class="text-center" style="vertical-align:middle;">
                                            <a href="{{\App\Helper\Common::article_link($article)}}" target="_blank" class="btn btn-icon"><img src="{{asset('/admin/assets/img/icon_preview.gif')}}"></a>
                                            @if(!$isPending || $article['user_id'] == Auth::user()->id)
                                            <a href="{{ route('article.edit', $article['id']) }}" class="btn btn-icon"
                                               title="@lang('app.edit')" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endif
                                            <?php if(!Auth::user()->hasPermission(['article.pending'])) { ?>
                                            <a href="{{ route('article.delete', $article['id']) }}" class="btn btn-icon"
                                               title="@if($article->status == -2) Delete Article. @else Move to trash. @endif"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="@lang('app.please_confirm')"
                                               data-confirm-text="{{trans(($article->status == -2?'Are you sure delete ":name" article'."\n"."You will never recovery again this article after deleted.":'Are you sure move ":name" article to trash'),["name"=>$article['title']])}}"
                                               data-confirm-delete="@if($article->status == -2) Yes, delete it. @else Yes, move it to trash. @endif">
                                                <i class="fas fa-trash" @if($article->status == -2) style="color: red;" @endif></i>
                                            </a>
                                            <?php } ?>
                                            <a href="javascript:;" class="btn btn-icon" title="Comments: {{$article->countComment()}}<br /> Tags: {{$article->countTag()}}<br /> Views Total: {{$article->times_read}}<br />Views today: {{$article->today_read}}"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="info-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-info-circle fa-w-16 fa-fw fa-lg"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z" class=""></path></svg></a>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"><em>@lang('app.no_records_found')</em></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    {!! $articles->render() !!}
                </div>
            </div>

        </div>
    </div>
    <div id="apply_tags" class="modal hide fade in" data-keyboard="false" data-backdrop="static" role="dialog">
        <div class="modal-dialog modal-lg" style="width:80%;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="display: block !important;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="float: left;">Apply Tags</h4>
                </div>
                <div class="modal-body" style="height: 200px !important;">
                    <div class="autocomplete-input form_line" wfd-id="27">
                        <label wfd-id="30">Tags <img src="{{asset('admin/assets/img/loading_bar.gif')}}" class="loader" alt="Loading..." style="display:none"></label>
                        <ul class="holder" wfd-id="123">
                            <li class="bit-input" id="search_tag_input" wfd-id="124"><input class="maininput"
                                                                                               type="text"
                                                                                               id="anonymous_element_2"
                                                                                               wfd-id="146"></li>
                        </ul>


                    </div>
                    <div id="result_apply_tags" style="padding-top: 5px;font-weight: bold;"></div>
                    <div style="float: right;padding-top: 15px;">
                    <a href="javascript:;" id="submit_apply_tags" class="btn btn-success" style="color: white;">Apply Tags</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


@stop
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.css') }}">
@stop
@section('scripts')
    <script src="{{asset("admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.js")}}"></script>
    <script>
        $('.quick-nav-tabs li a').click(function () {
            var arrTab = ['tab_quicklink', 'tab_search'];
            processTabs(this, arrTab, "quick-nav-tabs");
        });
        $("#btn_save_search_filter").click(function () {
            var _name = $('#save_search_filter').val().trim();
            if(!_name) {
                alert("Error: Search Filter is empty!");
                return false;
            }
            var _filter = {_token:$('meta[name=csrf-token]').attr('content'),name:_name,section:'article'};

            @if($arrFilter)
                @foreach($arrFilter as $key=>$vl)
                    @if(is_array($vl))
                        {!!  "_filter[\"".$key."\"]=Array()"!!}
                        @foreach($vl as $key1=>$vl1)
                            {!!"_filter[\"".$key."\"][".$key1."]='".$vl1."';"!!}
                        @endforeach
                    @else
                        {!!"_filter[\"".$key."\"]='".$vl."';"!!}
                    @endif
                @endforeach
            @endif
                $.ajax({
                    type: "POST",
                    url: "{{route('user.saveSearchFilter')}}",
                    data:_filter,
                    success: function (data) {
                        alert(data.message);
                    }
                });
        });
        $('.quickSelect').change(function () {
            var _name = $(this).attr('name');
            $('#article-search-form').find('input[name='+_name+']').val($(this).val());
            $('#article-search-form').submit();
        });
        $( "#search_tag" ).autocomplete({
            source:  function(request, response) {
                $.getJSON('{{route('article.searchTag')}}' + '?keyword=' + $("#search_tag").val(), {
                    term: request.term
                }, function(data) {
                    var array = !data ? [] : $.map(data, function(m) {
                        return {
                            label: m.name,
                            value: m.id
                        };
                    });
                    response(array);
                });
            },
            select: function (event, ui) {
                $("#search_tag").val(ui.item.label); // display the selected text
                $("#tag_id").val(ui.item.value); // save selected id to hidden input
                return false;
            }
        });

        $('.article-select').change(function () {
            var _showSelectAction = false;
            if($(this).is(':checked')) {
                _showSelectAction = true;
                $(this).parent().parent().addClass('row-selected');
            } else {
                var listCheck = getCheckArticle();
                if(listCheck.length > 0) {
                    _showSelectAction = true;
                }
                $(this).parent().parent().removeClass('row-selected');
            }
            if(_showSelectAction == true) {
                $('#select_action').prop('disabled',false);
            } else {
                $('#select_action').prop('disabled',true);
            }
        });

        function getCheckArticle() {
            var _list = Array();
            $('input[class=article-select]:checked').each(function() {
                _list.push($(this).val());
            });
            return _list;
        }
        // sort article
        $('#sortListArticle').sortable({
            update: function (event, ui) {
                var _listId = Array();
                $('input[class=article-select]').each(function() {
                    _listId.push($(this).val());
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('article.sort')}}",
                    data: {listId:_listId,_token:$('meta[name=csrf-token]').attr('content')}
                });
            }
        });
        // select action
        $('#select_action').change(function () {
            var _vl = $(this).val();
            var _textSelect = $(this).find('option:selected').text();
            if(_vl == 'apply-tags') {
                $("#apply_tags").modal(true);
                multipleTag();
            } else if(_vl == 'mark-headline') {
                $.ajax({
                    type: "POST",
                    url: "{{route('article.selectAction')}}",
                    data: {listId:getCheckArticle(),tag_ids:{1:{0:1,1:2}},_token:$('meta[name=csrf-token]').attr('content'),_action:'apply-tags'},
                    success: function (data) {
                        if(data.error != undefined) {
                            _message = 'Error: ' + data.error;
                            $('#result_apply_tags').css('color','red');
                            $('#result_apply_tags').html(_message);
                        } else {
                            currentSelectTagId = Array();
                            $('.del-tags').parent().remove();
                            alert("Apply Tags are successfully!");
                            $("input.article-select").prop('checked',false);
                            window.location.reload();
                        }

                    }
                });
            } else if(_vl) {
                var _message = '';
                if(_vl.indexOf('status') < 0) {
                    _message = 'You Move to "' + _textSelect + '" success!';
                } else {
                    _message = 'You set status to "' + _textSelect + '" success!';
                }
                $.ajax({
                    type: "POST",
                    url: "{{route('article.selectAction')}}",
                    data: {listId:getCheckArticle(),_token:$('meta[name=csrf-token]').attr('content'),_action:_vl},
                    success: function (data) {
                        if(data.error != undefined) {
                            alert(data.error);
                        } else {
                            alert(_message);
                            $("input.article-select").prop('checked',false);
                            window.location.reload();
                        }
                    }
                });
            }
            $('#select_action').val("");
        });
        var currentSelectTagId = Array();
        function multipleTag() {
            $( ".autocomplete-input input" ).autocomplete({
                html:true,
                source:  function(request, response) {
                    var _keyword = $(".autocomplete-input input").val();
                    $('.autocomplete-input .loader').show();
                    $.getJSON('{{route('article.searchTag')}}' + '?keyword=' + _keyword, function(data) {
                        var isNew = true;
                        var array = !data ? [] : $.map(data, function(m) {
                            if(_keyword.toLowerCase() == m.name.toLowerCase()) {
                                isNew = false;
                            }
                            return {
                                label: m.name,
                                value: m.id,
                                group:m.group,
                                group_id:m.group_id
                            };
                        });
                        if(isNew) {
                            var arrAdd = [{label:_keyword,value:'add',group:"Add Keywords",group_id:0}];
                            if(array.length > 0) {
                                for(var i in array) {
                                    arrAdd.push(array[i]);
                                }
                            }
                            array = arrAdd;
                        }
                        $('.autocomplete-input .loader').hide();
                        response( array );

                    });
                },
                select: function (event, ui) {
                    if(ui.item.value == 'add') {
                        $('.autocomplete-input .loader').show();
                        $.ajax({
                            type: "POST",
                            url: "{{route('tag.quickCreate')}}",
                            data: ui.item,
                            success: function (data) {
                                $('.autocomplete-input .loader').hide();
                                if(data.error != undefined) {
                                    $('#result_apply_tags').css('color','red');
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
            }).autocomplete("instance")._renderItem = function(ul, item) {
                if(item == null || item == undefined || item.group == undefined) {
                    return  $('<li>').append('').appendTo(ul);
                }
                var item = $('<div class="list_item_container"><b>' + item.group + '</b> ' + item.label +'</div>');
                return $("<li>").append(item).appendTo(ul);
            };
        }
        function tagSelected(_obj) {
            if(currentSelectTagId.length == 0 || currentSelectTagId[_obj.group_id] === undefined ||currentSelectTagId[_obj.group_id].length == 0 || currentSelectTagId[_obj.group_id].includes(_obj.value) === false) {
                if(currentSelectTagId.length == 0 || currentSelectTagId[_obj.group_id] === undefined) {
                    currentSelectTagId[_obj.group_id] = Array();
                }
                currentSelectTagId[_obj.group_id].push(_obj.value);
                $('#search_tag_input').before('<li class="bit bit-box"><span class="category">'+_obj.group+'</span> '+_obj.label+'<a href="javascript:;" class="closebutton del-tags" onclick="delSelectTag(this)" data-id="'+_obj.value+'" group-id="'+_obj.group_id+'"></a></li>');
                $('.autocomplete-input input').val('');
                $('.autocomplete-input input').focus();
            }
        }
        // delete select tag
        function delSelectTag(obj) {
            var tagId = $(obj).attr('data-id');
            var groupId = $(obj).attr('group-id');
            if(tagId && groupId) {
                $(obj).parent().remove();
                currentSelectTagId[groupId] = currentSelectTagId[groupId].filter(function(e) { return e != tagId });
            }
        }
        // submit apply tags
        $('#submit_apply_tags').click(function () {
            if(currentSelectTagId.length == 0) {
                alert("Error: You don't have select any tags.");
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{route('article.selectAction')}}",
                    data: {listId:getCheckArticle(),tag_ids:currentSelectTagId,_token:$('meta[name=csrf-token]').attr('content'),_action:'apply-tags'},
                    success: function (data) {
                        if(data.error != undefined) {
                            _message = 'Error: ' + data.error;
                            $('#result_apply_tags').css('color','red');
                            $('#result_apply_tags').html(_message);
                        } else {
                            currentSelectTagId = Array();
                            $('.del-tags').parent().remove();
                            alert("Apply Tags are successfully!");
                            $("input.article-select").prop('checked',false);
                            window.location.reload();
                        }

                    }
                });
            }
        });
        $( document ).tooltip({
            content:function(){
                return this.getAttribute("title");
            }
        });

    </script>
@stop
