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
                <div class="container" style="margin-bottom: 20px;">
                    <ul class="nav nav-tabs quick-nav-tabs">
                        <li class="active"><a href="javascript:;" data-id="tab_quicklink">Quick Link</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row" style="padding-left: 60px;">
            <div class="col-md-4">
                <div id="tab_quicklink" style="padding-left: 8px;">
                    <p><a href="{{route('article.create')}}" class="btn btn-primary">Add new article</a></p>
                    <p><a href="{{route('article.index')}}">All articles</a></p>
                    <p><a href="{{route('article.index')}}?status=0">Review pending articles ({{$articlePending}})</a></p>
                    <p><a href="{{route('comment.index')}}">All comments</a></p>
                    <p><a href="{{route('comment.index')}}?status=0">Moderate new comments ({{$commentPending}})</a></p>
                </div>
            </div>
            <div class="col-md-8">
                <h4>Statistics of Today</h4>
                <p>Total of <strong>{{number_format($articleToday)}}</strong> article views.</p>
                <p>Total of <strong>{{number_format($commentToday)}}</strong> comments posted.</p>
            </div>
        </div>
    </div>
</div>



@stop


