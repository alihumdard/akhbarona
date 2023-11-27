@extends('admin.layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.dashboard')
    </li>
@stop

@section('content')
    <div class="card">
        <div class="card-body" style="padding: 5px 0px !important;">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive" id="users-table-wrapper">
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th class="min-width-100">User Name</th>
                                <th>Log Actions</th>
                                <th>date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($logs))
                                @foreach ($logs as $log)
                                    <tr>
                                        <td style="vertical-align:middle;">
                                            {{$log->user_name}}
                                        </td>
                                        <td style="vertical-align:middle;">
                                            {{$log->action}}
                                        </td>
                                        <td style="vertical-align:middle;">
                                            {{$log->created_at}}
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
                    {!! $logs->render() !!}
                </div>
            </div>

        </div>
    </div>



@stop



