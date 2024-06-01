@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="container mt-5">
            <h1>Assignments for "{{ $student->username }}" in Course "{{ $course->course_title }}"</h1>
			
            <div class="row">
                @foreach ($assignments as $assignment)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">{{ $assignment->ass_title }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $assignment->ass_description }}</p>
                                <p><strong>Deadline:</strong> {{ $assignment->deadline }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h2>Add Grades for Assignment "{{ $assignment->ass_title }}"</h2>
            <form method="POST" action="{{ route('save_grades') }}">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->username }}</td>
                                <td><input type="number" name="grades[{{ $student->id }}]" class="form-control"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                <button type="submit" class="btn btn-primary">Save Grades</button>
            </form>
        </div>
    </div>
    <!-- row closed -->
</div>
<!-- Container closed -->
@endsection
@section('js')
@endsection