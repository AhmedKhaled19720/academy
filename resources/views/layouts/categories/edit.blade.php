
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <form action={{ route('categories.save') }} method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="old_id" value="{{$categoriesedit->id}}">
                <label>Id</label>
                <input type="text" class="form-control mb-4" name="id" value="{{ $categoriesedit->id }}">
                @error('id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label>Image</label>
                <input type="file" class="form-control mb-4" name="cate_image" >
                @error('cate_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label>Title_En</label>
                <input type="text" class="form-control mb-4" name="title_en" value="{{ $categoriesedit->title_en }}">
                {{-- @error('title_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}

                <label>Title_Ar</label>
                <input type="text" class="form-control mb-4" name="title_ar" value="{{ $categoriesedit->title_ar }}">
                {{-- @error('title_ar')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}

                <label>Description_En</label>
                <input type="text" class="form-control mb-4" name="description_en" value="{{ $categoriesedit->description_en }}">
                {{-- @error('description_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}

                <label>Description_Ar</label>
                <input type="text" class="form-control mb-4" name="description_ar" value="{{ $categoriesedit->description_ar }}">
                {{-- @error('description_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}



                <input type="submit" value="Update" class="btn btn-success btn-block">
            </form>
        </div>
    </div>
</div>

@endsection

