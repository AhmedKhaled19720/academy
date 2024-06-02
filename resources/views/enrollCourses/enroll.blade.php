@extends('layouts.master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
 <!-- Internal Data table css -->
 <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
 <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
 <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
 <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
 <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
 <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
 <!--Internal   Notify -->
 <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                
                <div class="card-header">Enroll User in Course</div>
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
                    <form method="POST" action="{{ route('enrollCourse.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="course_id">Course:</label>
                            <select name="course_id" id="course_id" class="form-control" onchange="updateUsersList(this.value)">
                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->course_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Select for users -->
                        <div class="form-group">
                            <label for="user_id">Student:</label>
                            <select name="user_id" id="user_id" class="form-control" onchange="updateUsersList(this.value)">
                                <option value="">Select user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                           <div class="mt-3 ">
                            <button type="submit" class="btn btn-main-primary btn-block">Enroll User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center"><h5>Enrollments List</h5></div>
                <div class="card-body">
                   
                    <div class="table-responsive table-center">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="text-primary">Id</th>
                                    <th class="text-primary">Username</th>
                                    <th class="text-primary">Course Title</th>
                                    <th class="text-primary">Status</th>
                                    <th class="text-primary">Registration Date</th>
                                    <th class="text-primary">Updated At</th>
                                    <th class="text-primary">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alldata as $item)
                                    <tr class="{{ $item->subscription_status == 'inactive' ? 'table-muted' : '' }}">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user->username }}</td>
                                        <td>{{ $item->course->course_title }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggleSubscriptionSwitch" type="checkbox"
                                                    id="toggleSubscriptionSwitch_{{ $item->id }}"
                                                    {{ $item->subscription_status == 'active' ? 'checked' : '' }}
                                                    data-id="{{ $item->id }}"
                                                    data-status="{{ $item->subscription_status == 'active' ? 'inactive' : 'active' }}">
                                                {{-- <label class="form-check-label"
                                                    for="toggleSubscriptionSwitch_{{ $item->id }}">{{ $item->subscription_status == 'active' ? 'Active' : 'Inactive' }}</label> --}}
                                            </div>
                                        </td>
                                        <td>{{ $item->registration_date }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a class="text-danger tx-16" href="#" data-toggle="modal"
                                                data-target="#deleteCourseModal{{ $item->id }}">
                                                <i class="fa-regular fa-trash-can tx-16 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>


                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteCourseModal{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteCourseModalLabel{{ $item->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="deleteCourseModalLabel{{ $item->id }}">
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
                                                    <form action="{{ route('enrollCourse.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
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
    </div>
    <!-- row closed -->


    <!-- row closed -->
    </div>
    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#course_id, #user_id').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>

    {{-- for delete --}}
    <script>
        $(document).ready(function() {
            $('.delete-course-btn').click(function() {
                var itemId = $(this).data('item-id');
                $('#deleteCourseModal' + itemId).modal('show');
            });

            $('.confirm-delete-btn').click(function() {
                var itemId = $(this).data('item-id');
                $('#deleteForm' + itemId).submit();
            });
        });
    </script>

    {{-- for status  --}}
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
    {{-- for selections  --}}

    <script>
        $(document).ready(function() {
            $('#course_id').select2();
            $('#user_id').select2();
        });
    </script>
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
@endsection
