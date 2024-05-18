@extends('layouts.master')
@section('css')
@endsection
{{-- @dd($course) --}}
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Courses</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Show course Details</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div  class="pr-1 mb-3 mb-xl-0" > <a class="btn btn-info btn-icon ml-2" href="{{ route('courses.edit', $course->id) }}"><i class="fa-regular fa-pen-to-square fa-lg mx-2"></i></a>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <a type="button" class="btn btn-info  btn-icon ml-2" href="{{ route('courses') }}"
                ><i class="mdi mdi-backburger"></i></a>
            </div>

            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" id="refreshPage" class="btn btn-danger  btn-icon ml-2"><i
                        class="mdi mdi-refresh"></i></button>
            </div>

            <div class="pr-1 mb-3 mb-xl-0">
                <a type="button" class="btn btn-dark btn-icon ml-2" href="{{route('home')}}"><i class="mdi mdi-home-outline"></i></a>
            </div>

        </div>
    </div>

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="card col-md-12">
            <div class="card-header ">
                <div>
                    <h5 class="text-gray"> {{ 'created at'." ".$course->created_at}} </h5>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class=" col-md-6">
                            <div class="d-flex">

                                <div class="form-group col-md-6 ">
                                    <label for="id" class="font-weight-bold">Course ID</label>
                                    <input type="text" class="form-control " id="id" value="{{ $course->id }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status" class="font-weight-bold">Status</label>
                                    <input type="text" class="form-control" id="status" value="{{ $course->status }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="course_title" class="font-weight-bold">Course Title</label>
                                <input type="text" class="form-control" id="course_title" value="{{ $course->course_title }}" readonly>
                            </div>
                            <div class="d-flex">
                            <div class="form-group col-md-6">
                                <label for="category" class="font-weight-bold">Category</label>
                                <input type="text" class="form-control " id="category" value="{{ $course->category->name }}" readonly>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="instructor" class="font-weight-bold">Instructor</label>
                                <input type="text" class="form-control" id="instructor" value="{{ $course->instructor->name }}" readonly>
                            </div>
                        </div>
                            <div class="form-group ">
                                <label for="course_description" class="font-weight-bold">Course Description</label>
                                <textarea class="form-control" id="course_description" rows="4" readonly>{{ $course->course_description }}</textarea>
                            </div>
                            <div class="d-flex">
                                <div class="form-group col-md-3">
                                    <label for="lecture_no" class="font-weight-bold">Lectures Number</label>
                                    <input type="text" class="form-control" id="lecture_no" value="{{ $course->lecture_no }}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="hours_no" class="font-weight-bold">Hours Number</label>
                                    <input type="text" class="form-control" id="hours_no" value="{{ $course->hours_no }}" readonly>
                                </div>



                                <div class="form-group col-md-3">
                                    <label for="price" class="font-weight-bold">Price (LE)</label>
                                    <input type="text" class="form-control" id="price" value="{{ $course->price }}" readonly>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="level" class="font-weight-bold">Level</label>
                                    <input type="text" class="form-control" id="level" value="{{ $course->level }}" readonly>
                                </div>

                            </div>


                        </div>
                        <div class="col-md-6 m-auto">
                            <div class="form-group m-auto">
                                <label for="course_img" class="font-weight-bold">Course Image</label>
                                <img src="{{ asset('courses/img/' . $course->course_img)}}" height="340" class="card m-auto" alt="Course Image" class="img-fluid">
                            </div>

                        </div>
                    </div>
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
     document.getElementById('refreshPage').addEventListener('click', function(event) {
            event.preventDefault();
            location.reload();
        });
</script>
@endsection
