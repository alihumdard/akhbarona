@extends('admin.layouts.app')

@section('page-title', trans('app.categories'))
@section('page-heading', trans('app.categories'))

@section ('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.categories')
    </li>
@stop

@section('content')

    @include('admin.partials.messages')



    <div class="card">
        <div class="card-body">
            <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-4 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="text"
                                   class="form-control input-solid"
                                   name="search"
                                   value="{{ Request::input('search') }}"
                                   placeholder="@lang('app.search_for_category')">

                            <span class="input-group-append">
                                @if (Request::input('search') && Request::input('search') != '')
                                    <a href="{{ route('category.index') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-users-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-2 mt-2 mt-md-0">

                    </div>

                    <div class="col-md-6">
                        <div class="float-right">
                        <a href="{{ route('category.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('app.add_category')
                        </a>
                        </div>
                    </div>

                </div>
            </form>



            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="mobile-hide">&nbsp;</th>
                        <th class="min-width-100">@lang('app.name')</th>
                        <th class="min-width-150">SE friendly URL</th>
                        <th class="min-width-150">Template</th>
                        <th class="min-width-150">Article Template</th>
                        <th class="text-center">Show in navigation</th>
                    </tr>
                    </thead>
                    <tbody id="sortListCategory">
                    @if (count($categories))
                        @foreach ($categories as $cat)
                            <tr>
                                <input type="hidden" name="category_select[]" class="category-select" value="{{$cat["id"]}}">
                                <td style="vertical-align:middle;" class="mobile-hide">
                                    <a href="javascript:;"><img src="{{asset('admin/assets/img/icons/move-action.png')}}"></a>
                                </td>
                                <td class="rtl">{{ $cat['category_name'] }}</td>
                                <td>{{ $cat['sefriendly'] }}</td>
                                <td>{{ $cat['template'] }}</td>
                                <td>
                                    {{$cat['article_template']}}
                                </td>
                                <td style="text-align: center;">
                                    @if($cat['view_subcat'] != 1)
                                        <span style="color: red;font-weight: bold">No</span>
                                    @else
                                        <span style="color: green;font-weight: bold;">Yes</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('category.edit', $cat['id']) }}" class="btn btn-icon"
                                       title="@lang('app.edit')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                        <a href="{{ route('category.delete', $cat['id']) }}" class="btn btn-icon"
                                           title="@lang('app.del_category')"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           data-method="DELETE"
                                           data-confirm-title="@lang('app.please_confirm')"
                                           data-confirm-text="{{trans('app.are_you_sure_delete_category',["name"=>$cat['category_name']])}}"
                                           data-confirm-delete="@lang('app.yes_delete_it')">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                </td>
                            </tr>
                            @if(isset($cat['child']) and count($cat['child']) > 0)
                                @foreach($cat['child'] as $child)
                                    <tr>
                                        <td style="vertical-align:middle;" class="mobile-hide">
                                            <input type="hidden" name="category_select[]" class="category-select" value="{{$child["id"]}}">
                                            <a href="javascript:;"><img src="{{asset('admin/assets/img/icons/move-action.png')}}"></a>
                                        </td>
                                        <td>-- {{ $child['category_name'] }}</td>
                                        <td>{{ $child['sefriendly'] }}</td>
                                        <td>{{ $child['template'] }}</td>
                                        <td>
                                            {{$child['article_template']}}
                                        </td>
                                        <td style="text-align: center;">
                                            @if($child['view_subcat'] != 1)
                                                <span style="color: red;font-weight: bold">No</span>
                                            @else
                                                <span style="color: green;font-weight: bold;">Yes</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('category.edit', $child['id']) }}" class="btn btn-icon"
                                               title="@lang('app.edit')" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="{{ route('category.delete', $child['id']) }}" class="btn btn-icon"
                                               title="@lang('app.del_category')"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="@lang('app.please_confirm')"
                                               data-confirm-text="{{trans('app.are_you_sure_delete_category',["name"=>$child['category_name']])}}"
                                               data-confirm-delete="@lang('app.yes_delete_it')">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"><em>@lang('app.no_records_found')</em></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
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
        // sort category
        $('#sortListCategory').sortable({
            update: function (event, ui) {
                var _listId = Array();
                $('input[class=category-select]').each(function() {
                    _listId.push($(this).val());
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('category.sort')}}",
                    data: {listId:_listId,_token:$('meta[name=csrf-token]').attr('content')}
                });
            }
        });
    </script>
@stop
