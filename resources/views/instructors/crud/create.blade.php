@extends('layouts.master')

@section('job')
    kian - Create New instructor
@stop

@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-job tx-20 mb-0 mr-1 my-auto">all instructors dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/create new instructor</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="container bg-white p-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <form action={{ route('instructors.save') }} method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">id</label>
                        <input type="number" class="form-control" name="id">
                        @error('id')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">image</label>
                        <input type="file" class="form-control" name="instructor_img">
                        @error('instructor_img')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">name</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" class="form-control" name="email">
                        @error('email')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">job</label>
                        <input type="text" class="form-control" name="job">
                        @error('job')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">description</label>
                        <input type="text" class="form-control" name="description">
                        @error('description')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" d-flex social_links">
                        <div class="form-group mr-2 p-0">
                            <label for="">facebook link</label>
                            <input type="text" class="form-control" name="instructor_facebook">
                            @error('instructor_facebook')
                                <div class="alert alert-primary mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mr-2 p-0">
                            <label for="">twitter link</label>
                            <input type="text" class="form-control" name="instructor_twitter">
                            @error('instructor_twitter')
                                <div class="alert alert-primary mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mr-2 p-0">
                            <label for="">instagram link</label>
                            <input type="text" class="form-control" name="instructor_insta">
                            @error('instructor_insta')
                                <div class="alert alert-primary mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mr-2 p-0">
                            <label for="">linkedin link</label>
                            <input type="text" class="form-control" name="instructor_linkedin">
                            @error('instructor_linkedin')
                                <div class="alert alert-primary mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <input class="btn btn-primary btn-block" type="submit" value="Create New instructor">
                </form>
            </div>
        </div>
    </div>
@endsection
