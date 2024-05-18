@extends('layouts.master')

@section('title')
    kian-Contact Us
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
                <h4 class="content-title tx-20 mb-0 mr-1 my-auto">all Contact Messages</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/Coutact US </span>
            </div>
        </div>


    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!--div-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if (@session('message'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('delete_category'))
                        <script>
                            window.onload = function() {
                                notif({
                                    msg: "deleted successfully",
                                    type: "success"
                                })
                            }
                        </script>
                        <!-- div -->
                    @endif

                    

                    <div class="table-responsive table-center">
                        <table class="table text-md-nowrap" id="example">
                            <thead>
                                <tr>
                                    
                                    <th class="text-primary">name</th>
                                    <th class="text-primary">E-mail</th>
                                    <th class="text-primary">phone</th>
                                    <th class="text-primary">massage</th>
                                    <th class="text-primary">Created_at</th>
                                    <th class="text-primary">Operation</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($alldata as $item)
                                    <tr>
                                        <td>{{ $item->full_name }}</td>
                                        
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->message }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="d-flex">
                                           

                                           

                                            <a class="text-danger tx-20" data-target="#modaldemo1" data-toggle="modal"
                                                data-category-id="{{ $item->id }}" href="#"><i
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
                                        <h6 class="modal-title">Delete Massage</h6>
                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Are you sure you want to delete this Massage?</h6>
                                    </div>
                                    <form id="deleteUserForm" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <input type="hidden" name="category_id" id="category_id">

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
                    var categoryId = button.data('category-id');
                    var modal = $(this);
                    modal.find('.modal-body #category_id').val(categoryId);
                    modal.find('#deleteUserForm').attr('action', '{{ route('categories.delete', ':id') }}'.replace(':id',
                        categoryId));
                });
            </script>

            <!--Internal  Notify js -->
            <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
        @endsection