@extends('layouts.master')

@section('title')
    kian-category edit
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
                <h4 class="content-title tx-20 mb-0 mr-1 my-auto">all categories dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/edit category</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 m-auto">
            <form action={{ route('setting.saveupdate') }} method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" name="old_id" value="{{ $setting->id }}">
                <input type="hidden" class="form-control" name="id" value="{{ $setting->id }}">

                <div class="form-group">
                    <label for="">title_banner_1</label>
                    <input type="text" class="form-control" name="title_banner_1" value="{{ $setting->title_banner_1 }}">
                    @error('title_banner_1')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">title_banner_2</label>
                    <input type="text" class="form-control" name="title_banner_2"
                        value="{{ $setting->title_banner_2 }}">
                    @error('title_banner_2')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">title_banner_3</label>
                    <input type="text" class="form-control" name="title_banner_3"
                        value="{{ $setting->title_banner_3 }}">
                    @error('title_banner_3')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">caption_banner</label>
                    <input type="text" class="form-control" name="caption_banner"
                        value="{{ $setting->caption_banner }}">
                    @error('caption_banner')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">instructor_title</label>
                    <input type="text" class="form-control" name="instructor_title"
                        value="{{ $setting->instructor_title }}">
                    @error('instructor_title')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">instructor_caption</label>
                    <input type="text" class="form-control" name="instructor_caption"
                        value="{{ $setting->instructor_caption }}">
                    @error('instructor_caption')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">instructor_become_title</label>
                    <input type="text" class="form-control" name="instructor_become_title"
                        value="{{ $setting->instructor_become_title }}">
                    @error('instructor_become_title')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">instructor_become_caption</label>
                    <input type="text" class="form-control" name="instructor_become_caption"
                        value="{{ $setting->instructor_become_caption }}">
                    @error('instructor_become_caption')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">discount_title_1</label>
                    <input type="text" class="form-control" name="discount_title_1"
                        value="{{ $setting->discount_title_1 }}">
                    @error('discount_title_1')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">discount_title_2</label>
                    <input type="text" class="form-control" name="discount_title_2"
                        value="{{ $setting->discount_title_2 }}">
                    @error('discount_title_2')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">discount_caption</label>
                    <input type="text" class="form-control" name="discount_caption"
                        value="{{ $setting->discount_caption }}">
                    @error('discount_caption')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">discount_percent</label>
                    <input type="text" class="form-control" name="discount_percent"
                        value="{{ $setting->discount_percent }}">
                    @error('discount_percent')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">discount_img</label>
                    <input type="file" class="form-control" name="discount_img"
                        value="{{ $setting->discount_img }}">
                    @error('discount_img')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">footer_address</label>
                    <input type="text" class="form-control" name="footer_address"
                        value="{{ $setting->footer_address }}">
                    @error('footer_address')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">footer_mail</label>
                    <input type="text" class="form-control" name="footer_mail" value="{{ $setting->footer_mail }}">
                    @error('footer_mail')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">footer_phone_1</label>
                    <input type="text" class="form-control" name="footer_phone_1"
                        value="{{ $setting->footer_phone_1 }}">
                    @error('footer_phone_1')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">footer_phone_2</label>
                    <input type="text" class="form-control" name="footer_phone_2"
                        value="{{ $setting->footer_phone_2 }}">
                    @error('footer_phone_2')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">footer_facebook</label>
                    <input type="text" class="form-control" name="footer_facebook"
                        value="{{ $setting->footer_facebook }}">
                    @error('footer_facebook')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">footer_twitter</label>
                    <input type="text" class="form-control" name="footer_twitter"
                        value="{{ $setting->footer_twitter }}">
                    @error('footer_twitter')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">footer_instagram</label>
                    <input type="text" class="form-control" name="footer_instagram"
                        value="{{ $setting->footer_instagram }}">
                    @error('footer_instagram')
                        <div class="alert alert-primary mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">footer_linkedin</label>
                    <input type="text" class="form-control" name="footer_linkedin"
                        value="{{ $setting->footer_linkedin }}">
                    @error('footer_linkedin')
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
