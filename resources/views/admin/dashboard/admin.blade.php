@extends('admin.layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.dashboard')
    </li>
@stop

@section('content')

<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-primary flex-1">
                        <i class="fa fa-users fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">{{ number_format($stats['total']) }}</h2>
                        <div class="text-muted">@lang('app.total_users')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-success flex-1">
                        <i class="fa fa-user-plus fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">{{ number_format($stats['new']) }}</h2>
                        <div class="text-muted">@lang('app.new_users_this_month')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-danger flex-1">
                        <i class="fa fa-user-slash fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">{{ number_format($stats['banned']) }}</h2>
                        <div class="text-muted">@lang('app.banned_users')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card widget">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-info flex-1">
                        <i class="fa fa-user fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">{{ number_format($stats['unconfirmed']) }}</h2>
                        <div class="text-muted">@lang('app.unconfirmed_users')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Business Beacon Board</h5>
                <div>
                    @include('dashboard.notice', ['notices' => $notices,'user_id'=>0] )
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <h5 class="card-title">
                        Event Calendar
                    </h5>
                </div>

                <div class="col-md-12">
                    @if($checkEvent)
                        <div class="tiva-events-calendar compact" data-source="php"></div>
                    @else
                        Don't have any events
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script>
        var events_php = "{{route('events.json')}}";
    </script>
    <!-- Include events calendar language file -->
    <script src="{{asset('admin/assets/plugins/tiva-events-calendar/admin/assets/languages/en.js')}}"></script>

    <!-- Include events calendar js file -->
    <script src="{{asset('admin/assets/plugins/tiva-events-calendar/admin/assets/js/calendar.js')}}"></script>
@stop
@section('styles')
    <!-- Include events calendar css file -->

    <link rel="stylesheet" href="{{asset('admin/assets/plugins/tiva-events-calendar/admin/assets/css/calendar.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/tiva-events-calendar/admin/assets/css/calendar_full.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/tiva-events-calendar/admin/assets/css/calendar_compact.css')}}">
@stop
