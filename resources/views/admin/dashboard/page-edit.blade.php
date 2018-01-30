@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Page
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
                                @case('education-nutrition')
                                   Education
                                    @break
                                @case('exercise-demo')
                                    Exercise Demonstration
                                    @break
                                @case('becoming-elite')
                                    Becoming Elite
                                    @break
                            @endswitch
                        </h3>
                    </div>
                    @include('admin.dashboard.page-form')
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
