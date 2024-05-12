@extends('layouts.master')

@section('title')
    kian - Create New category
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
                    class="text-muted tx-13 mr-2 mt-1">/create new category</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="container bg-white p-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <form action={{ route('categories.save') }} method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">id</label>
                        <input type="number" class="form-control" name="id">
                        @error('id')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">image</label>
                        <input type="file" class="form-control" name="cate_image">
                        @error('cate_image')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">name</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">title</label>
                        <input type="text" class="form-control" name="title">
                        @error('title')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">description</label>
                        <input type="text" class="form-control" name="description">
                        @error('description')
                            <div class="alert alert-primary mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <input class="btn btn-primary btn-block" type="submit" value="Create New category">
                </form>
            </div>
        </div>
    </div>
@endsection
