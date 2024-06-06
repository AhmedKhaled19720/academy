@extends('layouts.master')
@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">assignments</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ create a
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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <!-- row -->
                <form action="{{ route('assignments.update', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-12 d-flex flex-row">
                            <div class="col-md-6">

                                {{-- old_id  --}}
                                <input type="hidden" value="{{ $course->id }}" name="old_id">

                                {{-- ID --}}

                                <div class="form-group col-md-6">
                                    <label for="id" class="font-weight-bold">#ID</label>
                                    <input type="text" class="form-control" id="id" name="id" value="{{ $course->id }}" >
                                </div>
                                {{-- Title --}}
                                <div class="form-group col-md-12">
                                    <label for="course_title" class="font-weight-bold">Course Title</label>
                                    <input type="text" class="form-control" id="course_title" name="course_title" value="{{ $course->course_title }}" required>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group col-md-6">
                                        <label for="category_id" class="font-weight-bold">Course Category</label>
                                        <select class="form-control" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $course->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Instructor --}}
                                    <div class="form-group col-md-6">
                                        <label for="instructor_id" class="font-weight-bold">Course Instructor</label>
                                        <select name="instructor_id" id="instructor_id" class="form-control" required>
                                            <option value="">Select Instructor</option>
                                            @foreach ($instructors as $instructor)
                                                <option value="{{ $instructor->id }}" {{ $instructor->id == $course->instructor_id ? 'selected' : '' }}>
                                                    {{ $instructor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- Description --}}
                                <div class="form-group col-md-12">
                                    <label for="course_description" class="font-weight-bold">Course Description</label>
                                    <textarea class="form-control" id="course_description" name="course_description" rows="4">{{ $course->course_description }}</textarea>
                                </div>
                            </div>
                            {{-- Photo --}}
                            <div class="col-md-6 d-flex flex-column card m-auto">
                                <img class="card-img-top m-auto" src="{{ asset('storage/courses/img/' . $course->course_img) }}" id="preview" style="display: block;" alt="Course Image Preview" height="320">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bold" id="inputGroupFileAddon01">Upload Course Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="form-control-file" id="course_img" name="course_img" accept="image/*">
                                        <label class="custom-file-label font-weight-bold" for="course_img">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Lectures, Hours, Start Date --}}
                        <div class="col-md-12 d-flex flex-row">
                            <div class="form-group col-md-3">
                                <label for="lecture_no" class="font-weight-bold">Lectures Number</label>
                                <input type="number" class="form-control" id="lecture_no" name="lecture_no" value="{{ $course->lecture_no }}" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="hours_no" class="font-weight-bold">Hours Number</label>
                                <input type="number" class="form-control" id="hours_no" name="hours_no" value="{{ $course->hours_no }}" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="start_date" class="font-weight-bold">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $course->start_date }}" required>
                            </div>
                            {{-- Duration --}}
                            <div class="form-group col-md-3">
                                <label for="duration" class="font-weight-bold">Duration (months)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="duration" name="duration" value="{{ $course->duration }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text font-weight-bold">months</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Level, Status, Price --}}
                        <div class="col-md-12 d-flex flex-row">
                            <div class="form-group col-md-3">
                                <label for="level" class="font-weight-bold">Course Level</label>
                                <select class="form-control" id="level" name="level" required>
                                    <option value="">Select Course Level</option>
                                    <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="advanced" {{ $course->level == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="status" class="font-weight-bold">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active" {{ $course->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="disactive" {{ $course->status == 'disactive' ? 'selected' : '' }}>Disactive</option>
                                    <option value="archived" {{ $course->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="price" class="font-weight-bold">Price (LE)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $course->price }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text font-weight-bold">LE</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-flex d-block">Submit</button>
                </form>



            </div>
        </div>
    </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
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
