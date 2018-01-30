@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Weekly Content
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            @switch($content->type)
                                @case('overview')
                                    Weekly Overview
                                    @break
                            @endswitch
                        </h3>
                    </div>
                    <form method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="week" class="col-sm-2 control-label">Week</label>
                                <div class="col-sm-10">
                                    <input name="week" type="text" class="form-control" value="{{ $content->week }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="day" class="col-sm-2 control-label">Day</label>
                                <div class="col-sm-10">
                                    <input name="day" type="text" class="form-control" value="{{ $content->day }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control" value="{{ $content->title }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="col-sm-2 control-label">Content</label>
                                <div class="col-sm-10">
                                    <textarea name="content" type="text" class="textarea form-control" rows="10">{{ $content->content }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="source" class="col-sm-2 control-label">Source/Link</label>
                                <div class="col-sm-10">
                                    <input name="source" type="text" class="form-control" value="{{ $content->source }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="source_type" class="col-sm-2 control-label">Source Type</label>
                                <div class="col-sm-10">
                                    <label><input name="source_type" type="radio" class="square-green" value="video" @if ($content->source_type === 'video') checked @endif > Video</label>
                                    <label><input name="source_type" type="radio" class="square-green" value="image" @if ($content->source_type === 'image') checked @endif > Image</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="preview" class="col-sm-2 control-label">Preview Image</label>
                                <div class="col-sm-10">
                                    <input name="preview" type="text" class="form-control" value="{{ $content->preview }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label><input type="checkbox" name="published" value="1" class="square-green" @if ($content->published) checked @endif> Published</label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" href="{{ $redirect }}">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
