@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $title }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                @if (session('changes-saved'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    Changes saved.
                </div>
                @endif
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>Week</th>
                                    <th>Day</th>
                                    <th>Published</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Media Link</th>
                                </tr>
                                @foreach ($contents as $content)
                                <tr>
                                    <td><a href="{{ route('admin.dash.weeklyEdit', $content) }}"><i class="icon fa fa-pencil"></i></a></td>
                                    <td>{{ $content->week }}</td>
                                    <td>{{ $content->day }}</td>
                                    <td>@if ($content->published)<div class="form-group"><label><input type="radio" class="square-green" checked></label></div>@endif</td>
                                    <td>{{ $content->title }}</td>
                                    <td>{!! $content->content !!}</td>
                                    <td><a href="{{ $content->source }}">{{ $content->source }}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection