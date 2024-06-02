@extends('layouts.master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .form-check-input[type="checkbox"] {
            transform: scale(1) !important;
        }

        .form-check-input[type="checkbox"] {
            position: relative;
            width: 80px;
            height: 40px;
            -webkit-appearance: none;
            background: #c6c6c6;
            outline: none;
            border-radius: 20px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, .2);
            transition: .5s;
            transform: scale(.6);
            cursor: pointer;
        }

        .form-check-input:checked[type="checkbox"] {
            background: #03a9f4;
        }

        .form-check-input[type="checkbox"]:before {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 20px;
            top: 0;
            left: 0;
            background: #fff;
            transform: scale(0.9);
            box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
            transition: .5s;
        }

        .form-check-input:checked[type="checkbox"]:before {
            left: 40px;
        }

        .table-muted {
            background-color: #f9f9f9;
            color: #6c757d;
        }
    </style>
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Courses</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Show course Details</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a class="btn btn-info btn-icon ml-2" href=""><i class="fa-regular fa-pen-to-square fa-lg mx-2"></i></a>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <a type="button" class="btn btn-info btn-icon ml-2" href="{{ route('courses') }}"><i class="mdi mdi-backburger"></i></a>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" id="refreshPage" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <a type="button" class="btn btn-dark btn-icon ml-2" href="{{ route('home') }}"><i class="mdi mdi-home-outline"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center tx-lg-20">Add Grades To Students for task "{{ $assignmentName }}"</div>
                <div class="card-body">
                    @if (session()->has('create'))
                        <script>
                            window.onload = function() {
                                notif({
                                    msg: "Degree created successfully",
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
                    <h5 class="text text-center">Task Degree: {{ $taskDegree }}</h5>
                    <form method="POST" action="{{ route('grades.store', ['assignment' => $assignmentId]) }}">
                        @csrf
                      <!-- Select for users -->
<div class="form-group">
    <label for="user_id">Select User</label>
    <select name="user_id" id="user_id" class="form-control">
        <option value="">Select User</option>
        @foreach ($students as $student)
            @php
                $studentHasGrade = $student->grades()->where('assignment_id', $assignmentId)->exists();
            @endphp
            @if (!$studentHasGrade)
                <option value="{{ $student->id }}" {{ old('user_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->username }}
                </option>
            @endif
        @endforeach
    </select>
</div>


                        <!-- Input for grade -->
                        <div class="form-group">
                            <label for="grade">Grade</label>
                            <input type="number" class="form-control" name="grade" step="0.1" value="{{ old('grade') }}">
                        </div>

                       
                        <input type="hidden" name="assignment_id" value="{{ $assignmentId }}">
                        <input type="hidden" name="course_id" value="{{ $courseId }}">

                        <!-- Submit button -->
                        <div class="form-group">
                            <button class="btn btn-main-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.save-grade-btn').click(function() {
                var studentId = $(this).data('student-id');
                var gradeValue = $('input[name="grades[' + studentId + ']"]').val();

                // إرسال طلب الحفظ باستخدام AJAX أو تحديث الصفحة بشكل جزئي
            });
        });
    </script>

    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
