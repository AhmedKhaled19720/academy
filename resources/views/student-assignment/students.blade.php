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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

    <style>
        @media only screen and (max-width: 599px) and (min-width: 0px) {
            .form-check-input[type="checkbox"] {
                transform: scale(1) !important;
            }
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
    <!-- row -->
    <div class="row">

        <div class="card col-md-12">
            <div class="card-body">
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
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
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
                <h5 class="text-center">Course "{{ $course->course_title }}" Students
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-center">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                                <th>Assienments</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($course->students as $student)
                                <tr>
                                    <td>{{ $student->username }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->pivot->registration_date }}</td>

                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggleSubscriptionSwitch" type="checkbox"
                                                id="toggleSubscriptionSwitch_{{ $student->id }}"
                                                {{ $student->pivot->subscription_status == 'active' ? 'checked' : '' }}
                                                data-id="{{ $student->id }}"
                                                data-status="{{ $student->pivot->subscription_status == 'active' ? 'inactive' : 'active' }}">
                                            <label class="form-check-label"
                                                for="toggleSubscriptionSwitch_{{ $student->id }}">{{ $student->pivot->subscription_status == 'active' ? 'Active' : 'Inactive' }}</label>
                                        </div>
                                    </td>
                                    <td>

                                        <a href="{{ route('users.grades.show', ['userId' => $student->id, 'course_title' => $course->course_title]) }}"
                                            class=""><i class="fa-solid fa-square-poll-vertical tx-20"></i></i></a>
                                    </td>

                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteCourseModal{{ $student->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="deleteCourseModalLabel{{ $student->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCourseModalLabel{{ $student->id }}">
                                                    Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger confirm-delete-btn"
                                                    data-student-id="{{ $student->id }}">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
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
    <!-- Internal Data tables -->
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

    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    {{-- for delete --}}

    <script>
        $(document).ready(function() {
            $('.delete-course-btn').click(function() {
                var itemId = $(this).data('student-id');
                $('#deleteCourseModal' + itemId).modal('show');
            });

            $('.confirm-delete-btn').click(function() {
                var itemId = $(this).data('student-id');
                $('#deleteForm' + itemId).submit();
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggleSubscriptionSwitch').on('change', function() {
                var checkbox = $(this);
                var userId = checkbox.data('id');
                var newStatus = checkbox.is(':checked') ? 'active' : 'inactive';

                var url = '{{ route('toggle-subscription', ':id') }}';
                url = url.replace(':id', userId);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        subscription_status: newStatus
                    },
                    success: function(response) {
                        var statusText = newStatus === 'active' ? 'Active' : 'Inactive';
                        checkbox.next('label').text(statusText);

                    
                        if (newStatus === 'inactive') {
                            checkbox.closest('tr').addClass('table-muted');
                        } else {
                            checkbox.closest('tr').removeClass('table-muted');
                        }

                        alert('Subscription status updated successfully!');
                    },
                    error: function(response) {
                        alert('Failed to update subscription status.');
                        checkbox.prop('checked', !checkbox.is(
                            ':checked')); // Revert checkbox state on error
                    }
                });
            });
        });
    </script>
@endsection
