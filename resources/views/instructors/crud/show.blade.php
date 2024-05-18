@extends('layouts.master')

@section('title')
    kian-instructor show
@stop

@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title tx-20 mb-0 mr-1 my-auto">all instructors dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/instructor info</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-center">
                        <table class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-primary">id</th>
                                    <th class="text-primary">image</th>
                                    <th class="text-primary">name</th>
                                    <th class="text-primary">email</th>
                                    <th class="text-primary">job</th>
                                    <th class="text-primary">description</th>
                                    <th class="text-primary">social links</th>
                                    <th class="text-primary">Created At</th>
                                    <th class="text-primary">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $instructor->id }}</td>
                                    <td>
                                        <img style="width: 50px; height: 50px;"
                                            src={{ asset('instructors/img/' . $instructor->instructor_img) }} alt="instructor image">
                                    </td>
                                    <td>{{ $instructor->name }}</td>
                                    <td>{{ $instructor->email }}</td>
                                    <td>{{ $instructor->job }}</td>
                                    <td>{{ $instructor->description }}</td>
                                    <td class="d-flex">
                                        <a class="text-primary tx-20 mr-1" href={{ $instructor->instructor_facebook }}>
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                        <a class="text-primary tx-20 mr-1" href={{ $instructor->instructor_linkedin }}>
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                        <a class="text-primary tx-20 mr-1" href={{ $instructor->instructor_insta }}>
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a class="text-primary tx-20" href={{ $instructor->instructor_twitter }}>
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </td>
                                    <td>{{ $instructor->created_at }}</td>
                                    <td>
                                        <a class="text-primary tx-30" href={{ route('view_instructors') }}><i
                                                class="fas fa-house-user"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
@endsection
