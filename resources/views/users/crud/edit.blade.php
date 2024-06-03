@extends('layouts.master')

@section('title')
    kian-user edit
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
                <h4 class="content-title tx-20 mb-0 mr-1 my-auto">all users dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/edit user</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 m-auto">
            <form action={{ route('users.save') }} method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" name="old_id" value="{{ $user->id }}">

                <div class="form-group">
                    <label for="">id</label>
                    <input type="number" class="form-control" name="id" value="{{ $user->id }}">
                    @error('id')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">username</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                    @error('username')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    @error('email')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">phone</label>
                    <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}">
                    @error('phone')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">city</label>
                    <input type="text" class="form-control" name="city" value="{{ $user->city }}">
                    @error('city')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="active" {{ old('role', $user->role) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="disactive" {{ old('role', $user->role) == 'disactive' ? 'selected' : '' }}>Disactive</option>
                    </select>
                    @error('role')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subscription_status">subscription status</label>
                    <select name="subscription_status" id="subscription_status" class="form-control">
                        <option value="active" {{ old('subscription_status', $user->subscription_status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="disactive" {{ old('subscription_status', $user->subscription_status) == 'disactive' ? 'selected' : '' }}>Disactive</option>
                    </select>
                    @error('subscription_status')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <input class="btn btn-primary mb-5" type="submit" value="Update">
            </form>
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
