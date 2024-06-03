@extends('layouts.master')

@section('title')
    kian-users dashboard
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
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title tx-16 mb-0 mr-1 my-auto">all users dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/users</span>
            </div>
        </div>

        <a class="btn btn-outline-primary" href={{ route('users.create') }}>
            add new user</a>

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

                    @if (session()->has('created'))
                        <script>
                            window.onload = function() {
                                notif({
                                    msg: "created successfully",
                                    type: "success"
                                })
                            }
                        </script>
                        <!-- div -->
                    @endif

                    @if (session()->has('updated'))
                        <script>
                            window.onload = function() {
                                notif({
                                    msg: "updated successfully",
                                    type: "success"
                                })
                            }
                        </script>
                        <!-- div -->
                    @endif

                    @if (session()->has('delete_user'))
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
                                    <th class="text-primary">username</th>
                                    <th class="text-primary">email</th>
                                    <th class="text-primary">phone</th>
                                    <th class="text-primary">city</th>
                                    <th class="text-primary">role</th>
                                    <th class="text-primary">subscripion status</th>
                                    <th class="text-primary">Created_at</th>
                                    <th class="text-primary">Updated_at</th>
                                    <th class="text-primary">Operation</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggleStatusSwitch" type="checkbox"
                                                    id="toggleStatusSwitch_{{ $item->id }}"
                                                    {{ $item->role == 'active' ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggleStatusSwitch" type="checkbox"
                                                    id="toggleStatusSwitch_{{ $item->id }}"
                                                    {{ $item->subscription_status == 'active' ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td class="d-flex">
                                            <a class="text-primary tx-16" href={{ route('users.show', $item->id) }}>
                                                <i class="fas fa-eye"></i></a>

                                            <a class="text-primary mx-4 tx-16" href={{ route('users.edit', $item->id) }}>
                                                <i class="fas fa-pen-to-square"></i></a>

                                            <a class="text-danger tx-16" data-target="#modaldemo1" data-toggle="modal"
                                                data-user-id="{{ $item->id }}" href="#"><i
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
                                        <h6 class="modal-title">delete user</h6><button aria-label="Close" class="close"
                                            data-dismiss="modal" type="button"><span
                                                aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Are you sure to delete?</h6>
                                    </div>
                                    <form id="deleteUserForm" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <input type="hidden" name="user_id" id="user_id">

                                        <div class="modal-footer">
                                            <button class="btn btn-danger tx-18" type="submit">Delete</button>
                                            <button class="btn btn-primary" data-dismiss="modal"
                                                type="button">Close</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- End delete modal -->
                        </div>
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

    <script>
        $('#modaldemo1').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var userId = button.data('user-id');
            var modal = $(this);
            modal.find('.modal-body #user_id').val(userId);
            modal.find('#deleteUserForm').attr('action', '/user/delete/' + userId);
        });
    </script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.toggleStatusSwitch').change(function() {
                var isChecked = $(this).prop('checked');
                var userId = $(this).attr('id').split('_')[1];
                var newRole = isChecked ? 'active' : 'disactive';

                $.ajax({
                    url: '/toggle-status/' + userId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        role: newRole
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            var switchLabel = isChecked ? 'On' : 'Off';
                            $('#toggleStatusSwitch_' + userId).siblings('.form-check-label')
                                .text(switchLabel);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
