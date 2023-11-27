@extends('admin.layouts.app')

@section('page-title', trans('app.categories'))
@section('page-heading', $edit ? $cate->name : trans('app.add_category'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('category.index') }}">@lang('app.category')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ $edit ? trans('app.edit') : trans('app.create') }}
    </li>
@stop

@section('content')

    @include('admin.partials.messages')

    @if ($edit)
        {!! Form::open(['route' => ['category.store', $cate->id], 'method' => 'POST', 'id' => 'category-form']) !!}
    @else
        {!! Form::open(['route' => 'category.store', 'id' => 'category-form']) !!}
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('app.categories')
                    </h5>
                    <p class="text-muted">
                        A general category information.
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="category_name">@lang('app.name')</label>
                        <input type="text" class="form-control" id="category_name"
                               name="category_name" required="required" placeholder="@lang('app.category_name')" value="{{ $edit ? $cate->category_name : old('category_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="sefriendly">SE friendly URL</label>
                        <input name="sefriendly" required="required" type="text" id="sefriendly" class="form-control" value="{{ $edit ? $cate->sefriendly : old('sefriendly') }}">
                    </div>
                    <div class="form-group">
                        <label for="sefriendly">Parent category</label>
                        <select class="form-control">
                            <option value="0">Root</option>
                            <?php
                                if(count($arrCat) > 0) {
                                    foreach ($arrCat as $id=>$arr) {
                                        $selected = '';
                                        if($edit && $cate->parent_id == $id) {
                                            $selected = ' selected="selected"';
                                        }
                                        echo '<option value="'.$id.'"'.$selected.'>'.$arr['category_name'].'</option>';
                                        if(isset($arr['child'])) {
                                            foreach ($arr['child'] as $row) {
                                                if($edit && $cate->parent_id == $row['id']) {
                                                    $selected = ' selected="selected"';
                                                }
                                                echo '<option value="'.$row['id'].'"'.$selected.'>- '.$row['category_name'].'</option>';
                                            }
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="article_num">Number of articles</label>
                        <input type="number" name="article_num" id="article_num" class="form-control" value="{{ $edit ? $cate->article_num : old('article_num') }}">
                    </div>
                    <div class="form-group">
                        <label for="template">Custom layout (overrides default)</label>
                        <select class="form-control" name="template" id="template">
                            @foreach([""=>"Use system default","inherit"=>"Inherit","blog.tpl","default.tpl","default_sport.tpl","default_video.tpl","non_equal_video.tpl"] as $key=>$vl)
                                <option value="{{is_numeric($key)?$vl:$key}}" @if($edit && $cate->template == (is_numeric($key)?$vl:$key)) selected="selected" @endif>{{$vl}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="article_template">Article custom layout (overrides default)</label>
                        <select class="form-control" name="article_template" id="article_template">
                            @foreach([""=>"Use system default","inherit"=>"Inherit","blog.tpl","default.tpl","default_sport.tpl","image_gallery.tpl","two_column_video.tpl","two_column_video_sport.tpl","writers.tpl"] as $key=>$vl)
                                <option value="{{is_numeric($key)?$vl:$key}}" @if($edit && $cate->article_template == (is_numeric($key)?$vl:$key)) selected="selected" @endif>{{$vl}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Show in navigation</label>
                        <div class="custom-control custom-checkbox">
                            <input type="radio" value="1" name="view_subcat" @if($edit && $cate->view_subcat == 1) checked="checked" @endif> Yes &nbsp;&nbsp; <input type="radio" value="0" name="view_subcat" @if($edit && $cate->view_subcat == 0) checked="checked" @endif> No
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <button type="submit" class="btn btn-primary">
            {{ $edit ? trans('app.update_category') : trans('app.add_category') }}
        </button>
@stop
