@extends('layouts.master')

@section('title')
    kian-Courses dashboard
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
                <h4 class="content-title tx-20 mb-0 mr-1 my-auto">all Courses dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/courses</span>
            </div>
        </div>

        <a class="btn btn-outline-primary" href={{ route('courses.create') }}>
            add new Course</a>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
    <!--div-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
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

                    <div class="table-responsive table-center">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#id</th>
                                    <th>Course Title</th>
                                    <th>Start Date</th>
                                    <th>Category</th>
                                    <th>Instructor</th>
                                    <th>operation</th>
                                    <th>Assignment</th>
                                    <th>Students</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($alldata as $course)
                                    <tr>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->course_title }}</td>
                                        <td>{{ $course->start_date }}</td>
                                        <td>{{ $course->category->name }}</td>
                                        <td>{{ $course->instructor->name }}</td>
                                        <td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteCourseModal{{ $course->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="deleteCourseModalLabel{{ $course->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteCourseModalLabel{{ $course->id }}">Confirm
                                                                Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this course?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <!-- Delete Course Form -->
                                                            <form action="{{ route('courses.destroy', $course->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('courses.show', ['id' => $course->id]) }}">
                                                <i class="fa-solid fa-eye tx-16 text-primary"></i>
                                            </a>

                                            <a href="{{ route('courses.edit', $course->id) }}"><i
                                                    class="fa-regular fa-pen-to-square tx-16 text-primary mx-2"
                                                    style="color: #74C0FC;"></i></a>
                                            <a class="text-danger tx-20 delete-course" href="#" data-toggle="modal"
                                                data-target="#deleteCourseModal{{ $course->id }}">
                                                <i class="fa-regular fa-trash-can  tx-16 text-danger"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('assignments.create', ['id' => $course->id]) }}">
                                                <i class="fas fa-notes-medical tx-20 text-info"></i>
                                            </a>
                                            <a href="{{ route('assignments.show', ['id' => $course->id]) }}">
                                                <i class="fa-solid fa-eye tx-16 text-info"></i>
                                            </a>
                                        </td>
                                        <td>

                                            <a href="{{ route('courses.students', ['id' => $course->id]) }}"
                                                class="fas fa-users-rectangle tx-20 text-warning"></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
            <!--/div-->
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
            <!-- Internal Modal js-->



            <script>
                $(document).ready(function() {
                $('.delete-course-btn').on('click', function(event) {
                var courseId = $(this).data('course-id');
                var deleteUrl = "{{ route('courses.destroy', ':id') }}";
                deleteUrl = deleteUrl.replace(':id', courseId);
                window.location.href = deleteUrl;
                });
                });
             </script>



                <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
                <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
            @endsection
