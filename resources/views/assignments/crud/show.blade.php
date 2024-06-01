@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Empty</span>
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
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
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
    <div class="row">

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

        @if (session()->has('delete_assignment'))
            <script>
                window.onload = function() {
                    notif({
                        msg: "deleted successfully",
                        type: "danger"
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
        <div class="card col-md-12">
            <div class="card-header bg-dark text-white mb-2">
                <h5 class="text-center">Course "{{ $course->course_title }}" Assignments
                </h5>
            </div>
            <div class="row">
                @foreach ($assignments as $assignment)
                    @php
                        $now = now();
                        $deadline = \Carbon\Carbon::parse($assignment->deadline);
                        $remainingDays = $now->diffInDays($deadline, false);

                        if ($remainingDays < 0) {
                            $cardClass = ' bg-dark';
                            $remainingText = 'Time is up';
                        } elseif ($remainingDays === 0) {
                            $cardClass = ' bg-dark';
                            $remainingText = 'Time is up';
                        } elseif ($remainingDays <= 3) {
                            $cardClass = 'bg-warning';
                            $remainingText = $remainingDays . ' Days';
                        } elseif ($remainingDays <= 7) {
                            $cardClass = 'bg-info';
                            $remainingText = $remainingDays . ' Days';
                        } else {
                            $cardClass = 'bg-primary';
                            $remainingText = $remainingDays . ' Days';
                        }
                    @endphp
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-header bg-danger pb-0 {{ $cardClass }} ">
                                <h5 class="card-title mb-0 pb-0 text-white pb-3">{{ $assignment->ass_title }}</h5>
                            </div>
                            <div class="card-body text-primary">

                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Deadline</strong>
                                    </div>
                                    <div class="col-md-6">{{ $assignment->deadline }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Remaining</strong>
                                    </div>
                                    <div class="col-md-6">{{ $remainingText }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Degree</strong>
                                    </div>
                                    <div class="col-md-6">{{ $assignment->degree }}</div>
                                </div>


                            </div>

                            <div class="card-footer d-flex m-auto">
                                <a href="#" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#showAssignment{{ $assignment->id }}">
                                    <i class="fas fa-eye"></i></a>
                                </a>
                                <a href="#" class="btn btn-outline-info mx-3" data-toggle="modal"
                                    data-target="#editAssignment{{ $assignment->id }}">
                                    <i class="fas fa-pen-to-square"></i></a>
                                </a>

                                <button type="button" class="btn btn-outline-danger delete-assignment-btn"
                                    data-assignment-id="{{ $assignment->id }}" data-toggle="modal"
                                    data-target="#deleteModal">
                                    <i class="fas fa-trash-can"></i></a>
                                </button>


                            </div>
                            <div class="card-footer d-flex flex-column align-items-center">

                                <a href="{{ route('assignments.students', ['assignment' => $assignment->id]) }}"
                                    class="btn btn-outline-info tx-12 mb-2">
                                    add Students Degree
                                </a>
                                <a href="{{ route('assignments.all_students', ['assignment' => $assignment->id]) }}"
                                    class="btn btn-outline-info tx-12">
                                    Show All Students Grades
                                </a>

                            </div>
                        </div>
                    </div>


                    @include('assignments.modals.edit_ass_modal')
                    @include('assignments.modals.view_ass_modal')
                    @include('assignments.modals.delete_ass_modal')
                @endforeach
            </div>
            <!-- row closed -->

            <!-- row closed -->

            <!-- Delete Confirmation Modal -->
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('refreshPage').addEventListener('click', function(event) {
            event.preventDefault();
            location.reload();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete-assignment-btn').on('click', function() {
                var assignmentId = $(this).data('assignment-id');
                var deleteUrl = "{{ route('assignments.destroy', ':id') }}";
                deleteUrl = deleteUrl.replace(':id', assignmentId);

                console.log('Assignment ID:', assignmentId);
                console.log('Delete URL:', deleteUrl);

                $('#deleteAssignmentForm').attr('action', deleteUrl);
            });
        });
    </script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
