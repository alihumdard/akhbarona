@extends('admin.layouts.app')

@section('page-title', trans('app.add_user'))
@section('page-heading', trans('app.create_new_user'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('user-admin.list') }}">Admin Accounts</a>
    </li>
    <li class="breadcrumb-item active">
        @lang('app.create')
    </li>
@stop

@section('content')

@include('admin.partials.messages')

{!! Form::open(['route' => 'user-admin.store', 'files' => true, 'id' => 'user-form']) !!}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('app.user_details')
                    </h5>
                    <p class="text-muted font-weight-light">
                        A general user profile information.
                    </p>
                </div>
                <div class="col-md-9">
                    @include('admin.user-admin.partials.details', ['edit' => false, 'profile' => false])
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('app.login_details')
                    </h5>
                    <p class="text-muted font-weight-light">
                        Details used for authenticating with the application.
                    </p>
                </div>
                <div class="col-md-9">
                    @include('admin.user-admin.partials.auth', ['edit' => false])
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                @lang('app.create_user')
            </button>
        </div>
    </div>
{!! Form::close() !!}

<br>
@stop

@section('scripts')
    {!! HTML::script('admin/assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop
