@extends('layouts.master')

@section('title')
    kian - setting
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
                <h4 class="content-title tx-16 mb-0 mr-1 my-auto">all categories dashboard</h4><span
                    class="text-muted tx-13 mr-2 mt-1">/create new category</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="row bg-white">

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

        <div class="col-md-10 m-auto setting p-3">
            @foreach ($setting as $item)
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-primary my-3" href={{ route('setting.edit', $item->id) }}>edit</a>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>title_banner_1</p>
                    <p>{{ $item->title_banner_1 }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>title_banner_2</p>
                    <p>{{ $item->title_banner_2 }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>title_banner_3</p>
                    <p>{{ $item->title_banner_3 }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>caption_banner</p>
                    <p>{{ $item->caption_banner }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>instructor_title</p>
                    <p>{{ $item->instructor_title }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>instructor_caption</p>
                    <p>{{ $item->instructor_caption }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>instructor_become_title</p>
                    <p>{{ $item->instructor_become_title }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>instructor_become_caption</p>
                    <p>{{ $item->instructor_become_caption }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>discount_title_1</p>
                    <p>{{ $item->discount_title_1 }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>discount_title_2</p>
                    <p>{{ $item->discount_title_2 }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>discount_caption</p>
                    <p>{{ $item->discount_caption }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>discount_percent</p>
                    <p>{{ $item->discount_percent }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>discount_image</p>
                    <img style="width: 50px; height: 50px;" src={{ asset('setting/img/' . $item->discount_img) }}
                        alt="setting">
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_address_link</p>
                    <p>{{ $item->footer_address_link }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_address_iframe</p>
                    <p>{{ $item->footer_address_iframe }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_mail</p>
                    <p>{{ $item->footer_mail }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_phone_1</p>
                    <p>{{ $item->footer_phone_1 }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_phone_2</p>
                    <p>{{ $item->footer_phone_2 }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_facebook</p>
                    <p>{{ $item->footer_facebook }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_twitter</p>
                    <p>{{ $item->footer_twitter }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_instagram</p>
                    <p>{{ $item->footer_instagram }}</p>
                </div>

                <div
                    class="main-setting d-flex justify-content-between align-items-center bg-light text-primary p-2 mb-1 fw-bold tx-18 rounded-5">
                    <p>footer_linkedin</p>
                    <p>{{ $item->footer_linkedin }}</p>
                </div>
            @endforeach
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

    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
