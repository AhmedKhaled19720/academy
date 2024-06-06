@extends('layouts.master')
@section('title')
    kian-Courses assignments
@stop
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
                <h4 class="content-title mb-0 my-auto">all assignments</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    assignments</span>
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
                @if (count($assignments) > 0)
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
                                        <div class="col-md-5">
                                            <strong>Deadline</strong>
                                        </div>
                                        <div class="col-md-6">{{ $assignment->deadline }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <strong>Remaining</strong>
                                        </div>
                                        <div class="col-md-6">{{ $remainingText }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
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
                                         {{-- ADD degrees to users  --}}
                                    <a href="{{ route('assignments.students', ['assignment' => $assignment->id]) }}"
                                        class="btn btn-outline-info tx-12 mb-2">
                                        add Students Degree
                                    </a>

                                    {{-- <a href="{{ route('assignments.all_students', ['assignment' => $assignment->id]) }}"
                                        class="btn btn-outline-info tx-12">
                                        Show All Students Grades
                                    </a> --}}

                                </div>
                            </div>
                        </div>


                        @include('assignments.modals.edit_ass_modal')
                        @include('assignments.modals.view_ass_modal')
                        @include('assignments.modals.delete_ass_modal')
                    @endforeach
                @else
                <div class="card-body">
                    <h5 class="alert alert-warning text-center">
                        No Assignments Available in this Course.
                    </h5>
                    <h5 class="text-center">To add New Assienment to This course click here  <a href="{{ route('assignments.create', ['id' => $course->id]) }}">
                        <i class="fas fa-notes-medical tx-20 text-info mx-2"></i>
                    </a></h5>
                </div>


            </div>
        </div>
        @endif
    </div>
    <!-- row closed -->

    <!-- row closed -->

    <!-- Delete Confirmation Modal -->
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
