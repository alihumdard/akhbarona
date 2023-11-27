@extends('admin.layouts.app')

@section('page-title', 'Pages')
@section('page-heading', 'Pages')

@section ('breadcrumbs')
    <li class="breadcrumb-item active">
        Pages
    </li>
@stop

@section('content')

    @include('admin.partials.messages')



    <div class="card">
        <div class="card-body" style="padding: 5px 0px !important;">
            <div class="row">

                <div class="col-md-3">
                    <div class="row" style="padding: 10px 0px 10px;text-align: center;">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary add-new-page">Add new page</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="users-table-wrapper">
                                <table class="table table-striped table-borderless">
                                    <tbody id="sortListPage">
                                    @if (count($pages))
                                        @foreach ($pages as $page)
                                            <tr>

                                                <td style="vertical-align:middle;padding: 5px 0px 5px 5px;cursor: move;">
                                                    <input type="hidden" name="page_select[]" class="page-select" value="{{$page->id}}">
                                                   {{$page->title}}
                                                </td>
                                                <td class="text-center" style="vertical-align:middle; min-width: 80px;padding: 5px 0px 5px 5px;">
                                                    <a href="javascript:;" data-url="{{ route('page.edit', $page) }}" data-id="{{$page->id}}" class="btn btn-icon edit-page"
                                                       title="@lang('app.edit')" data-toggle="tooltip" data-placement="top">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="{{ route('page.delete', $page) }}" class="btn btn-icon"
                                                       title="Delete Page"
                                                       data-toggle="tooltip"
                                                       data-placement="top"
                                                       data-method="DELETE"
                                                       data-confirm-title="@lang('app.please_confirm')"
                                                       data-confirm-text="{{trans('Are you sure delete ":name" page',["name"=>$page->title])}}"
                                                       data-confirm-delete="@lang('app.yes_delete_it')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2"><em>@lang('app.no_records_found')</em></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9" style="padding-right: 30px;">
                    <form action="{{route("page.store")}}" method="post" id="page_form">
                        {!! csrf_field() !!}
                        <input type="hidden" name="page_id" id="page_id">
                    <div class="row" style="padding-top: 6px;">
                        <div class="col-md-12">
                            <h4 id="title_form">Add new page</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="author">Title</label>
                                <input type="text" name="title" id="title" value="" required="required" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <label for="page_layout">Custom layout (overrides default):</label>
                        <select id="page_layout" name="template">
                            <option value="" selected="selected">

                                Use system default
                            </option>


                            <option value="default.tpl">

                                default.tpl
                            </option>
                        </select>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <label for="sefriendly">URL:</label>
                        <input type="text" id="sefriendly" name="sefriendly">
                    </div>

                    <div class="form-group">
                        <textarea name="body" class="form-control" id="body_page"></textarea>
                    </div>
                    <div class="row" style="padding-bottom: 10px;margin-top: 10px;">
                        <div class="col-md-12" style="text-align: right; padding-top: 10px; padding-right: 40px;"><button type="submit" class="btn btn-primary">Save</button></div>
                    </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    @include("admin/file/modal_poup")
@stop
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.css') }}">
@stop
@section('scripts')
    <script src="{{asset("admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.js")}}"></script>
    <script  src="{{asset("/admin/assets/js/tiny_mce/tiny_mce.js")}}"></script>
    <script>
        // sort page
        $('#sortListPage').sortable({
            update: function (event, ui) {
                var _listId = Array();
                $('input[class=page-select]').each(function() {
                    _listId.push($(this).val());
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('page.sort')}}",
                    data: {listId:_listId,_token:$('meta[name=csrf-token]').attr('content')},
                    success: function (data) {
                        if(data.error == 0) {
                            showNoticeSuccess(data);
                        } else {
                            showNoticeError(data);
                        }
                    }
                });
            }
        });
        var _cdn_url = "{{Config::get('app.cdn_url')}}";
        var pageTiny = tinyMCE.init({
            mode: "exact",
            elements: "body_page",
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
                "adminPage" in window && ed.onChange.add(adminPage.onContentChange.bind(adminPage));
            }
        });

    </script>
    @yield("script_modal")
    <script>
        var selectImageId = null;
        $(".content-page").on('click','.edit-page',function () {
            $("#modal_loading").modal('toggle');
            var url = $(this).attr("data-url");
            $("#page_id").val($(this).attr("data-id"));
            $("#title_form").html("Edit page");
            $.ajax({
                type: "POST",
                url: url,
                data: {_token:$('meta[name=csrf-token]').attr('content')},
                success: function (data) {
                    $("#sefriendly").val(data.sefriendly);
                    $("#title").val(data.title);
                    tinymce.get('body_page').setContent(data.body);
                    $("#page_layout").val(data.template);
                    $("#modal_loading .close").click();
                }
            });
        });
        $(".add-new-page").click(function () {
            $("#title_form").html("Add new page");
            $("#page_form").get(0).reset();
            $("#page_id").val(0)
        });

    </script>
@stop
