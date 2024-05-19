@extends('layouts.master')

@section('job')
    kian-instructor edit
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
                <h4 class="content-job tx-20 mb-0 mr-1 my-auto">all instructsor dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/edit instructor</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 m-auto">
            <form action={{ route('instructors.saveupdate') }} method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" name="old_id" value="{{ $instructor->id }}">

                <div class="form-group">
                    <label for="">id</label>
                    <input type="number" class="form-control" name="id" value="{{ $instructor->id }}">
                    @error('id')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">name</label>
                    <input type="text" class="form-control" name="name" value="{{ $instructor->name }}">
                    @error('name')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">email</label>
                    <input type="email" class="form-control" name="email" value="{{ $instructor->email }}">
                    @error('email')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">image</label>
                    <input type="file" class="form-control" name="instructor_img">
                    @error('instructor_img')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">job</label>
                    <input type="text" class="form-control" name="job" value="{{ $instructor->job }}">
                    @error('job')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">description</label>
                    <input type="text" class="form-control" name="description" value="{{ $instructor->description }}">
                    @error('description')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class=" d-flex social_links">
                    <div class="form-group mr-2 p-0">
                        <label for="">facebook link</label>
                        <input type="text" class="form-control" name="instructor_facebook" value="{{ $instructor->instructor_facebook }}">
                        @error('instructor_facebook')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mr-2 p-0">
                        <label for="">twitter link</label>
                        <input type="text" class="form-control" name="instructor_twitter" value="{{ $instructor->instructor_twitter }}">
                        @error('instructor_twitter')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mr-2 p-0">
                        <label for="">instagram link</label>
                        <input type="text" class="form-control" name="instructor_insta" value="{{ $instructor->instructor_insta }}">
                        @error('instructor_insta')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mr-2 p-0">
                        <label for="">linkedin link</label>
                        <input type="text" class="form-control" name="instructor_linkedin" value="{{ $instructor->instructor_linkedin }}">
                        @error('instructor_linkedin')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>
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
