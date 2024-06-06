@extends('layouts.master')
@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Courses</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ create a
                    new course</span>
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
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card col-md-10">
            <div class="card-header text-center">
                <h5>Edit Course</h5>
            </div>
            <div class="card-body ">
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
                <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Left column -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <!-- Course Title -->
                                    <div class="form-row">
                                        <div class="form-group col-md-9">
                                            <label for="course_title" class="font-weight-bold">Course Title</label>
                                            <input type="text" class="form-control" id="course_title" name="course_title"
                                                value="{{ $course->course_title }}">
                                            @error('course_title')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="status" class="font-weight-bold">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="active" {{ $course->status == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="disactive"
                                                    {{ $course->status == 'disactive' ? 'selected' : '' }}>Disactive
                                                </option>
                                                <option value="archived"
                                                    {{ $course->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Course Category & Instructor -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="category_id" class="font-weight-bold">Course Category</label>
                                            <select class="form-control" id="category_id" name="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $course->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="instructor_id" class="font-weight-bold">Course Instructor</label>
                                            <select name="instructor_id" id="instructor_id" class="form-control">
                                                <option value="">Select Instructor</option>
                                                @foreach ($instructors as $instructor)
                                                    <option value="{{ $instructor->id }}"
                                                        {{ $instructor->id == $course->instructor_id ? 'selected' : '' }}>
                                                        {{ $instructor->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('instructor_id')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Course Description -->
                                    <div class="form-group">
                                        <label for="course_description" class="font-weight-bold">Course Description</label>
                                        <textarea class="form-control" id="course_description" name="course_description" rows="4">{{ $course->course_description }}</textarea>
                                        @error('course_description')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Start Date & Duration -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="start_date" class="font-weight-bold">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date"
                                                value="{{ $course->start_date }}">
                                            @error('start_date')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="level" class="font-weight-bold">Course Level</label>
                                            <select class="form-control" id="level" name="level">
                                                <option value="">Select Course Level</option>
                                                <option value="beginner"
                                                    {{ $course->level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                                <option value="intermediate"
                                                    {{ $course->level == 'intermediate' ? 'selected' : '' }}>Intermediate
                                                </option>
                                                <option value="advanced"
                                                    {{ $course->level == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                            @error('level')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Lectures Number, Hours Number, Duration & Price -->
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="lecture_no" class="font-weight-bold">Lectures Number</label>
                                            <input type="number" class="form-control" id="lecture_no" name="lecture_no"
                                                value="{{ $course->lecture_no }}">
                                            @error('lecture_no')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="hours_no" class="font-weight-bold">Hours Number</label>
                                            <input type="number" class="form-control" id="hours_no" name="hours_no"
                                                value="{{ $course->hours_no }}">
                                            @error('hours_no')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="duration" class="font-weight-bold">Duration (months)</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="duration"
                                                    name="duration" value="{{ $course->duration }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text font-weight-bold">months</span>
                                                </div>
                                            </div>
                                            @error('duration')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="price" class="font-weight-bold">Price (LE)</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="price" name="price"
                                                    value="{{ $course->price }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text font-weight-bold">LE</span>
                                                </div>
                                            </div>
                                            @error('price')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body" style="height: calc(100% - 2.25rem);">
                                    <!-- Course Image -->
                                    <div class="form-group">
                                        <label for="course_img" class="font-weight-bold">Course Image</label>
                                        <img class="card m-auto" src="{{ asset('courses/img/' . $course->course_img) }}"
                                            id="preview" style="display: block; margin-top: 10px;"
                                            alt="Course Image Preview" height="400">
                                        <input type="file" class="form-control-file pt-3" id="course_img"
                                            name="course_img" accept="image/*">
                                        @error('course_img')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right column -->



                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        document.getElementById('course_img').addEventListener('change', function(event) {
            if (event.target.files.length === 0) {
                // No file selected, hide the image preview
                document.getElementById('preview').style.display = 'none';
            } else {
                var reader = new FileReader();
                reader.onload = function() {
                    var img = document.getElementById('preview');
                    img.src = reader.result;
                    img.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    </script>
@endsection
