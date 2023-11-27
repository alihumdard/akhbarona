@extends('admin.layouts.app')

@section('page-title', "Admin Accounts")
@section('page-heading', "Admin Account")

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        Admin Accounts
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
                               placeholder="Search for admin Account...">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::input('search') != '')
                                    <a href="{{ route('user-admin.list') }}"
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
                    {!! Form::select('status', $statuses, Request::input('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-6">
                    <a href="{{ route('user-admin.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        Add Admin Account
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th class="min-width-80">@lang('app.username')</th>
                    <th class="min-width-150">@lang('app.full_name')</th>
                    <th class="min-width-100">@lang('app.email')</th>
                    <th class="min-width-80">@lang('app.role')</th>
                    <th class="min-width-80">@lang('app.status')</th>
                    <th class="text-center min-width-150">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($users))
                        @foreach ($users as $user)
                            @include('admin.user-admin.partials.row',['roles'=>$roles])
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><em>@lang('app.no_records_found')</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{!! $users->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });
    </script>
@stop
