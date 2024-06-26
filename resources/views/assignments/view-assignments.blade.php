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
                <h4 class="content-title tx-20 mb-0 mr-1 my-auto">all assignments</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/assignments</span>
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
                    <div class="table-responsive table-center">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#id</th>
                                    <th>Task Title</th>
                                    <th>description</th>
                                    <th>file</th>
                                    <th>deadline</th>
                                    {{-- <th>Course</th> --}}
                                    <th>Notes</th>
                                    <th>degree</th>
                                    <th>created at</th>
                                    <th>updated at</th>
                                    <th>Operation</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($assignments as $assigment)
                                    <tr>
                                        <td>{{ $assigment->id }}</td>
                                        <td>{{ $assigment->ass_title }}</td>
                                        <td>{{ $assigment->ass_description }}</td>
                                        <td>{{ $assigment->ass_file }}</td>
                                        <td>{{ $assigment->deadline }}</td>
                                        {{-- <td>{{ $assigment->courses->course_title }}</td> --}}
                                        <td>{{ $assigment->notes }}</td>
                                        <td>{{ $assigment->degree }}</td>
                                        <td>{{ $assigment->created_at }}</td>
                                        <td>{{ $assigment->updated_at }}</td>
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
                < script >
                    $(document).ready(function() {
                        $('.delete-course-btn').on('click', function(event) {
                            var courseId = $(this).data('course-id');
                            var deleteUrl = "{{ route('courses.destroy', ':id') }}";
                            deleteUrl = deleteUrl.replace(':id', courseId);
                            window.location.href = deleteUrl;
                        });
                    });
            </script>

            </script>

            <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
        @endsection
