@extends('admin.layouts.app')

@section('page-title', 'Comments')
@section('page-heading', 'Comments')

@section ('breadcrumbs')
    <li class="breadcrumb-item active">
        Comments
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
                        <p><a href="{{route('comment.index')}}">All</a></p>
                        <p><a href="{{route('comment.index')}}?status=0">Pending</a></p>
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
                        <form action="" style="padding-left: 8px;" method="GET" id="comment-search-form" class="pb-2 mb-3 border-bottom-light">

                            <input type="hidden" name="per_page" value="{{$per_page}}">

                            <input type="hidden" name="sort_by" value="{{(isset($_GET['sort_by'])?$_GET['sort_by']:'')}}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keyword">Keyword(s)</label>
                                        <input type="text" name="keyword" id="keyword" class="form-control" value="{{isset($arrFilter['keyword'])?$arrFilter['keyword']:''}}" placeholder="Search keyword">
                                        <input type="hidden" name="article_id" value="{{isset($_GET["article_id"])?$_GET["article_id"]:0}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Name</label>
                                        <input type="text" name="author" id="author" value="{{isset($arrFilter['author'])?$arrFilter['author']:''}}" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" value="{{isset($arrFilter['email'])?$arrFilter['email']:''}}" class="form-control" placeholder="Search email">
                                    </div>
                                    <div class="form-group">
                                        <label for="ip">IP</label>
                                        <input type="text" id="ip" name="ip" value="{{isset($arrFilter['ip'])?$arrFilter['ip']:''}}" class="form-control" placeholder="Search IP">
                                    </div>
                                    <div class="form-group">
                                        <label for="search_tag">Date</label>
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
                                    <div class="form-group" style="padding-top: 10px;">
                                        <button type="submit" class="btn btn-success">Search now</button> &nbsp; <a href="{{route('comment.index')}}">clear search</a>
                                    </div>
                                </div>
                            </div>



                        </form>
                        <div style="padding-left: 8px;">
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
                    <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
                        <div class="row my-3 flex-md-row flex-column-reverse">
                            <div class="col-md-4 mt-md-0 mt-2">
                                <div class="input-group custom-search-form">
                                    <select name="select_action" id="select_action" class="form-control" disabled="disabled">
                                        @foreach($selectAction as $key=>$arr)
                                            @if(!isset($arr['label']))
                                                <option value="{{$key}}">{{$arr}}</option>
                                            @else
                                                <optgroup label="{{$arr['label']}}">

                                                    @foreach($arr['child'] as $cKey=>$cVl)
                                                        <option value="{{$cKey}}">{{$cVl}}</option>
                                                    @endforeach

                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 mt-2 mt-md-0">

                            </div>



                        </div>
                    </form>


                    <div class="row">
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
                            <?php $total = $comments->total(); $toTotal = $comments->currentPage()*$comments->perPage();?>
                            {{(($comments->currentPage()-1)*$comments->perPage())+1}} - {{$toTotal > $total?$total:$toTotal}} of {{$total}}
                        </div>
                        <div class="col-md-6">
                            {!! $comments->render() !!}
                        </div>
                    </div>
                    <div class="table-responsive" id="users-table-wrapper">
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th colspan="2" class="min-width-100" style="text-align: center;max-width: 75%;">@lang('app.title')</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($comments))
                                <?php $arrColorStatus = [0=>'btn-dark',1=>'btn-success',-1=>'btn-warning',-2=>'btn-danger',""=>"btn-dark"]?>
                                @foreach ($comments as $comment)
                                    <?php $comment->status = (int)$comment->status; ?>
                                    <tr>
                                        <td style="vertical-align:middle;">
                                            <input style="height: 20px;width: 20px;" type="checkbox" name="article_select[]" class="comment-select" value="{{$comment->id}}">
                                        </td>
                                        <td style="vertical-align:middle;display: block;">
                                            <div id="edit_comment_{{$comment["id"]}}">{{$comment["description"]}}</div>
                                            <p><strong>{{$comment['author']}}</strong> on <a href="{{route('comment.index')}}?article_id={{$comment['article_id']}}">{{ $comment['title'] }}</a></p>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            @if(isset($arrStatus[$comment->status]))
                                                <span class="btn {{(isset($arrColorStatus[$comment->status])?$arrColorStatus[$comment->status]:'btn-dark')}}">{{$arrStatus[$comment->status]}}</span>
                                            @else
                                                'N/A'
                                            @endif
                                        </td>
                                        <td class="text-center" style="vertical-align:middle;min-width: 125px;">

                                            <a href="javascript:;" class="btn btn-icon edit-comment" data-id="{{$comment["id"]}}"
                                               title="@lang('app.edit')" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-icon" title="On: {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$comment['create_dt'])->format("Y d M")}}<br /> IP: {{$comment["ip"]}}<br /> Email: {{$comment["email"]}}"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="info-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-info-circle fa-w-16 fa-fw fa-lg"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z" class=""></path></svg></a>
                                            <a href="{{ route('comment.delete', $comment['id']) }}" class="btn btn-icon"
                                               title="Delete Comment"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="@lang('app.please_confirm')"
                                               data-confirm-text="{{trans('Are you sure delete ":name" comment',["name"=>$comment['description']])}}"
                                               data-confirm-delete="@lang('app.yes_delete_it')">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><em>@lang('app.no_records_found')</em></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    {!! $comments->render() !!}
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
            var _filter = {_token:$('meta[name=csrf-token]').attr('content'),name:_name,section:'comment'};

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
            $('#comment-search-form').find('input[name='+_name+']').val($(this).val());
            $('#comment-search-form').submit();
        });
        $('.comment-select').change(function () {
            var _showSelectAction = false;
            if($(this).is(':checked')) {
                _showSelectAction = true;
                $(this).parent().parent().addClass('row-selected');
            } else {
                var listCheck = getCheckComment();
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
        function getCheckComment() {
            var _list = Array();
            $('input[class=comment-select]:checked').each(function() {
                _list.push($(this).val());
            });
            return _list;
        }
        // select action
        $('#select_action').change(function () {
            var _vl = $(this).val();
            var _textSelect = $(this).find('option:selected').text();
            var _message = '';
            if(_vl == 'delete') {
                _message = 'deleted is successfully!';
            } else {
                _message = 'You set status to "' + _textSelect + '" success!';
            }
            $.ajax({
                type: "POST",
                url: "{{route('comment.selectAction')}}",
                data: {listId:getCheckComment(),_token:$('meta[name=csrf-token]').attr('content'),_action:_vl},
                success: function (data) {
                    if(data.error != undefined) {
                        alert(data.error);
                    } else {
                        alert(_message);
                        $("input.comment-select").prop('checked',false);
                        window.location.reload();
                    }
                }
            });
            $('#select_action').val("");
        });
        $( document ).tooltip({
            content:function(){
                return this.getAttribute("title");
            }
        });
        var currentComment = [];
        $(".edit-comment").click(function () {
            var _id = $(this).attr('data-id');
            console.log("currentComment",currentComment);
            console.log("_id",_id);
            if(currentComment[_id] !== undefined && currentComment[_id]) {
                $('#edit_comment_' + _id).html(currentComment[_id]);
                currentComment[_id] = '';
            } else {
                currentComment[_id] = $('#edit_comment_' + _id).html();
                var _editContent = '<div class="row">';
                _editContent += '<div class="col-md-12">';
                _editContent += '<textarea rows="4" style="width: 100%">'+currentComment[_id]+'</textarea>';
                _editContent += '<button type="button" class="btn btn-success" onclick="saveComment('+_id+')">Save</button>';
                _editContent += '</div>';
                $('#edit_comment_' + _id).html(_editContent);
            }
        });
        function saveComment(commentId) {
            var _commentContent = $('#edit_comment_' + commentId + ' textarea').val();
            $.ajax({
                type: "POST",
                url: "{{route('comment.store')}}",
                data: {id:commentId,_token:$('meta[name=csrf-token]').attr('content'),des:_commentContent},
                success: function (data) {
                    if(data.error == 1) {
                        alert(data.message);
                    } else {
                        $('#edit_comment_' + commentId).html(_commentContent);
                        currentComment[commentId] = '';
                    }
                }
            });
        }
    </script>
@stop
