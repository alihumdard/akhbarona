@extends('admin.layouts.app')

@section('page-title', 'Settings')
@section('page-heading', 'Settings')

@section ('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="javascript:;">{{ucfirst($type)}}</a>
    </li>
@stop

@section('content')
    @include('admin.partials.messages')
    <?php $fileName = 'admin.setting.'.$type;?>
    <div class="card settings">
        <div class="card-body" style="padding: 5px 0px !important;">
            <form action="{{route('setting.store',[$type])}}" method="post">
                {{csrf_field()}}
                @include($fileName,[$settings,$type])
                <div class="row">
                    <div class="col-md-6">
                        &nbsp;
                    </div>
                    <div class="col-md-6 left">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if($type == 'general')
        @include("admin/file/modal_poup")
    @endif
@stop
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.css') }}">
@stop
@section('scripts')
    <script src="{{asset("admin/assets/js/jquery-ui-1.12.1/jquery-ui.min.js")}}"></script>
    <script>
        $('.setting-email-nav-tabs li a').click(function () {
            var arrTab = ['tab_email_options', 'tab_email_to_friend'];
            processTabs(this, arrTab, "setting-email-nav-tabs");
        });
    </script>
    @if($type == 'general')
    @yield("script_modal")
    <script>
        /** select image **/
        var _currentType = null;
        var selectImageId = null;
        /** insert image **/
        $('#setting_logo_select_image').click(function () {
            selectImageId = 'VIVVO_GENERAL_WEBSITE_LOGO_image';
            if ($("#popup_file_modal .list-folder").html() == '' || _currentType != 1) {
                getListFolder(1);
                _currentType = 1;
                $("#modal_loading").modal('toggle');
            } else {
                $('#popup_file_modal').modal(true);
            }
        });
        var listTimeZones = {!!  json_encode($timezones)!!};
        $( "#VIVVO_GENERAL_TIME_ZONE_FORMAT" ).autocomplete({
            source: listTimeZones
        });
    </script>

    @endif
@stop

