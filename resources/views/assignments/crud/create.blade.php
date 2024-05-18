@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet" />
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
                <button type="button" class="btn btn-info  btn-icon ml-2"><i class="mdi mdi-backburger"></i></button>
            </div>

            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" id="refreshPage" class="btn btn-danger  btn-icon ml-2"><i
                        class="mdi mdi-refresh"></i></button>
            </div>

            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-dark btn-icon ml-2"><i class="mdi mdi-home-outline"></i></button>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body">

                <form id="create-course-form" action="{{ route('courses.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-12 d-flex flex-row">
                            <div class="col-md-6">
                                <div class="form-group col-md-6">
                                    <input type="hidden" class="form-control" id="id" name="id" value={{rand(1, 1000) . time()}}>
                                </div>

                                <div class="form-group col-md-12 ">
                                    <label for="course_title" class="font-weight-bold ">Course Title</label>
                                    <input type="text" class="form-control" id="course_title" name="course_title">
                                </div>
                                @error('course_title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="d-flex  col-md-12">
                                    <div class="form-group col-md-6 ">
                                        <div class="d-flex justify-content-between">
                                        <label for="category_id" class="font-weight-bold">Course Category</label>
                                        <a href="{{route('categories.create')}}"><i class="fa-solid fa-circle-plus fa-lg" style="color: #74C0FC;"></i></a>

                                    </div>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                         @enderror
                                    </div>
                                    
                                    {{-- Instructor --}}
                                    <div class="form-group  col-md-6">
                                        <div class="d-flex justify-content-between">
                                            <label for="instructor_id" class="font-weight-bold">Course Instructor</label>
                                                <a href="{{route('instructors.create')}}"><i class="fa-solid fa-circle-plus fa-lg" style="color: #74C0FC;"></i></a>
                                        </div>
                                          <select name="instructor_id" id="instructor_id" class="form-control">
                                            <option value="">Select Instructor</option>
                                            @foreach ($instructors as $instructor)
                                                <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('instructor_id')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                         @enderror
                                    </div>
                                    
                                </div>



                                {{-- Description --}}
                                <div class="form-group col-md-12">
                                    <label for="course_description" class="font-weight-bold">Course Description</label>
                                    <textarea class="form-control" id="course_description" name="course_description" rows="4"></textarea>
                                </div>
                                @error('course_description')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="d-flex col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="start_date" class="font-weight-bold">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date">
                                        @error('start_date')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                         @enderror
                                    </div>
                                    {{-- Duration --}}
                                    <div class="form-group col-md-6">
                                        <label for="duration" class="font-weight-bold">Duration (months)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="duration" name="duration">
                                            <div class="input-group-append">
                                                <span class="input-group-text font-weight-bold">months</span>
                                            </div>
                                        </div>
                                        @error('duration')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                         @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Photo --}}
                            <div class="col-md-6 d-flex flex-column">

                                <img class="card m-auto" src="{{ asset('assets/img/courses/defult-img.jpg') }}"
                                    id="preview" style="display: block;" alt="Course Image Preview" height="300">
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bold" id="inputGroupFileAddon01">Upload
                                            Course Image</span>
                                    </div>
                                    <div class="custom-file">

                                        <input type="file" class="form-control-file" id="course_img"
                                            name="course_img" accept="image/*">
                                        <label class="custom-file-label font-weight-bold" for="course_img">Choose
                                            file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Lectures, Hours, Start Date --}}
                        <div class="col-md-12 d-flex flex-row">
                            {{-- Category & Instructor --}}

                            <div class="form-group col-md-3">
                                <label for="lecture_no" class="font-weight-bold">Lectures Number</label>
                                <input type="number" class="form-control" id="lecture_no" name="lecture_no">
                                @error('lecture_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                           
                            <div class="form-group col-md-3">
                                <label for="hours_no" class="font-weight-bold">Hours Number</label>
                                <input type="number" class="form-control" id="hours_no" name="hours_no">
                                @error('hours_no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="level" class="font-weight-bold">Course Level</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="">Select Course Level</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                                @error('level')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="price" class="font-weight-bold">Price (LE)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="price" name="price">
                                    <div class="input-group-append">
                                        <span class="input-group-text font-weight-bold">LE</span>
                                    </div>
                                   
                                </div>
                                @error('price')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror

                                <input type="hidden" id="status" name="status" value="Active">
                                {{-- <div class="form-group col-md-3">
                                <label for="status" class="font-weight-bold">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="" >Select Status</option>
                                    <option value="active"class="text-success">Active</option>
                                    <option value="disactive" class="text-danger">Disactive</option>
                                    <option value="archived" class="text-info">Archived</option>
                                </select>
                            </div> --}}

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-flex  align-items-center">Submit</button>
                </form>

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
        document.getElementById('status').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var input = document.getElementById('status');
            input.classList.remove('bg-success', 'bg-danger', 'bg-secondary'); // Remove previous color classes
            if (selectedOption.value === 'active') {
                input.classList.add('bg-success');
            } else if (selectedOption.value === 'disactive') {
                input.classList.add('bg-danger');
            } else if (selectedOption.value === 'archived') {
                input.classList.add('bg-secondary');
            }
        });
    </script>
    <script>
        document.getElementById('refreshPage').addEventListener('click', function(event) {
            event.preventDefault();
            location.reload();
        });

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
    <script>
        $(document).ready(function() {
            // Check if there is a success message in the session
            @if (session('success'))
                // Display the success message using Toastr
                toastr.success('{{ session('success') }}');
                // Alternatively, you can use SweetAlert
                // Swal.fire({
                //     icon: 'success',
                //     title: 'Success!',
                //     text: '{{ session('success') }}',
                // });
            @endif
        });
    </script>
@endsection
