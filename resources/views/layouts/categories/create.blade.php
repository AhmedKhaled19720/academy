@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <form action={{ route('categories.store') }} method="post" enctype="multipart/form-data">
                @csrf

                <label>Id</label>
                <input type="text" class="form-control mb-4" name="id">
                @error('id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label>Image</label>
                <input type="file" class="form-control mb-4" name="cate_image">
                @error('cate_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label>Title_En</label>
                <input type="text" class="form-control mb-4" name="title_en">
                @error('title_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label>Title_Ar</label>
                <input type="text" class="form-control mb-4" name="title_ar">
                @error('title_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label>Description_En</label>
                <input type="text" class="form-control mb-4" name="description_en">
                @error('description_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label>Description_Ar</label>
                <input type="text" class="form-control mb-4" name="description_ar">
                @error('description_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror



                <input type="submit" value="Create New category" class="btn btn-success btn-block">

                <a class="btn btn-primary mt-3" href={{ route('home') }}><i class="fa-solid fa-house"></i> </a>

            </form>
        </div>
    </div>
</div>

@endsection
