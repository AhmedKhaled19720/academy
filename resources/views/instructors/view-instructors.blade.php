@extends('layouts.master')

@section('title')
    kian-instructors dashboard
@stop
@php
    use Illuminate\Support\Str;
@endphp
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
                <h4 class="content-title tx-16 mb-0 mr-1 my-auto">all instructors dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/instructors</span>
            </div>
        </div>

        <a class="btn btn-outline-primary" href={{ route('instructors.create') }}>
            add new instructor</a>

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

                    @if (session()->has('delete_instructor'))
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
                        <table class="table text-md-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th class="text-primary">Id</th>
                                    <th class="text-primary">image</th>
                                    <th class="text-primary">name</th>
                                    <th class="text-primary">job</th>
                                    <th class="text-primary">description</th>
                                    <th class="text-primary">social links</th>
                                    <th class="text-primary">Created_at</th>
                                    <th class="text-primary">Updated_at</th>
                                    <th class="text-primary">Operation</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($instructor as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <img style="width: 50px; height: 50px;"
                                                src={{ asset('instructors/img/' . $item->instructor_img) }}
                                                alt="instructors">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->job }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>

                                            @if ($item->instructor_facebook === null)
                                            @else
                                                <a class="text-primary tx-16 mr-1"
                                                    href="{{ Str::startsWith($item->instructor_facebook, 'http') ? $item->instructor_facebook : 'http://' . $item->instructor_facebook }}"
                                                    target="_blank">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            @endif

                                            @if ($item->instructor_linkedin === null)
                                            @else
                                                <a class="text-primary tx-16 mr-1"target="_blank"
                                                    href="{{ Str::startsWith($item->instructor_linkedin, 'http') ? $item->instructor_linkedin : 'http://' . $item->instructor_linkedin }}">
                                                    <i class="fab fa-linkedin"></i>
                                                </a>
                                            @endif

                                            @if ($item->instructor_insta === null)
                                            @else
                                                <a class="text-primary tx-16 mr-1" target="_blank"
                                                    href="{{ Str::startsWith($item->instructor_insta, 'http') ? $item->instructor_insta : 'http://' . $item->instructor_insta }}">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            @endif

                                            @if ($item->instructor_twitter === null)
                                            @else
                                                <a class="text-primary tx-16"target="_blank"
                                                    href="{{ Str::startsWith($item->instructor_twitter, 'http') ? $item->instructor_twitter : 'http://' . $item->instructor_twitter }}">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            @endif

                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td class="d-flex">
                                            <a class="text-primary tx-16" href={{ route('instructors.show', $item->id) }}>
                                                <i class="fas fa-eye"></i></a>

                                            <a class="text-primary mx-4 tx-16"
                                                href={{ route('instructors.edit', $item->id) }}>
                                                <i class="fas fa-pen-to-square"></i></a>

                                            <a class="text-danger tx-16" data-target="#modaldemo1" data-toggle="modal"
                                                data-instructor-id="{{ $item->id }}" href="#"><i
                                                    class="fas fa-trash-can"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- delete modal -->
                        <div class="modal" id="modaldemo1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Delete instructor</h6>
                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Are you sure you want to delete this instructor?</h6>
                                    </div>
                                    <form id="deleteUserForm" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <input type="hidden" name="instructor_id" id="instructor_id">

                                        <div class="modal-footer">
                                            <button class="btn btn-danger tx-18" type="submit">Delete</button>
                                            <button class="btn btn-primary" data-dismiss="modal"
                                                type="button">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

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
            <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

            <script>
                $('#modaldemo1').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var instructorId = button.data('instructor-id');
                    var modal = $(this);
                    modal.find('.modal-body #instructor_id').val(instructorId);
                    modal.find('#deleteUserForm').attr('action', '{{ route('instructors.delete', ':id') }}'.replace(':id',
                        instructorId));
                });
            </script>

            <!--Internal  Notify js -->
            <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
        @endsection
