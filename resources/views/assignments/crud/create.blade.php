@extends('layouts.master')
@section('title')
    kian-Courses add assignments
@stop
@section('css')
    <link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">assignments</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ add assignment
                    </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">

        <div class="card col-md-12">

            <h5 class="card-header">Create Assignment for <span class="text text-info">{{ $course->course_title }}</span></h5>
            @if (session()->has('create'))
            <script>
                window.onload = function() {
                    notif({
                        msg: "created successfully",
                        type: "success"
                    })
                }
            </script>
        @endif
        @if (session()->has('update'))
            <script>
                window.onload = function() {
                    notif({
                        msg: "updated successfully",
                        type: "success"
                    })
                }
            </script>
        @endif

        @if (session()->has('delete_courses'))
            <script>
                window.onload = function() {
                    notif({
                        msg: "deleted successfully",
                        type: "success"
                    })
                }
            </script>
        @endif

        @if ($errors->any())
            <div class="alert alert-outline-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-body">
            <form action="{{ route('assignments.store', ['course_id' => $course->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="ass_title" class="col-sm-2 col-form-label text font-weight-bolder">Title</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="ass_title" id="ass_title" value="{{ old('ass_title') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ass_description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="ass_description" id="ass_description" rows="6">{{ old('ass_description') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ass_file" class="col-sm-2 col-form-label form-label">File</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control-file" name="ass_file" id="ass_file">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deadline" class="col-sm-2 col-form-label form-label">Deadline</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="deadline" id="deadline" value="{{ old('deadline') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="degree" class="col-sm-2 col-form-label form-label">Degree</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="degree" id="degree" value="{{ old('degree') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="notes" class="col-sm-2 col-form-label form-label">Notes</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="notes" id="notes" rows="3">{{ old('notes') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Create Assignment</button>
                    </div>
                </div>
            </form>
        </div>

        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <script>
        document.getElementById('refreshPage').addEventListener('click', function(event) {
            event.preventDefault();
            location.reload();
        });
    </script>
@endsection
