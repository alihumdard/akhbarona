@extends('admin.layouts.app')

@section('page-title', trans('app.my_profile'))
@section('page-heading', trans('app.my_profile'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.my_profile')
    </li>
@stop

@section('content')

@include('admin.partials.messages')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active"
                           id="details-tab"
                           data-toggle="tab"
                           href="#details"
                           role="tab"
                           aria-controls="home"
                           aria-selected="true">
                            @lang('app.user_details')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           id="authentication-tab"
                           data-toggle="tab"
                           href="#login-details"
                           role="tab"
                           aria-controls="home"
                           aria-selected="true">
                            @lang('app.login_details')
                        </a>
                    </li>

                </ul>

                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade show active px-2" id="details" role="tabpanel" aria-labelledby="nav-home-tab">
                        {!! Form::open(['route' => 'profile.update.details', 'method' => 'PUT', 'id' => 'details-form']) !!}
                            @include('admin.user-admin.partials.details', ['profile' => true])
                        {!! Form::close() !!}
                    </div>

                    <div class="tab-pane fade px-2" id="login-details" role="tabpanel" aria-labelledby="nav-profile-tab">
                        {!! Form::open(['route' => 'profile.update.login-details', 'method' => 'PUT', 'id' => 'login-details-form']) !!}
                            @include('admin.user-admin.partials.auth')
                        {!! Form::close() !!}
                    </div>


                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'profile.update.avatar', 'files' => true, 'id' => 'avatar-form']) !!}
                    @include('admin.user-admin.partials.avatar', ['updateUrl' => route('profile.update.avatar-external')])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    {!! HTML::script('admin/assets/js/as/btn.js') !!}
    {!! HTML::script('admin/assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\UpdateDetailsRequest', '#details-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\UpdateProfileLoginDetailsRequest', '#login-details-form') !!}


@stop
