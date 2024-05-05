@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center">
                    <div>
                        Categories <span class="badge badge-info"> {{ count($categoriestable) }} </span>
                    </div>
                    <a href={{ route('categories.create') }} class="btn btn-success">Create New Category</a>
                </div>

                @if (session('message'))
                    <h3 class="alert alert-success text-center">{{ session('message') }}</h3>
                @endif
                <div class="card-body">
                    <table class="table ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Image</th>

                                <th>Id</th>

                                <th>Title_En</th>
                                <th>Title_Ar</th>
                                <th>Description_En</th>
                                <th>Description_Ar</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoriestable as $rows)
                                <tr>
                                    <td>
                                        <img src={{ asset('categories/img/'. $rows->cate_image) }}
                                            style="height:70px ; width:70px">
                                    </td>
                                    <td> {{ $rows->id }} </td>
                                    <td> {{ $rows->title_en }} </td>
                                    <td> {{ $rows->title_ar }} </td>
                                    <td> {{ $rows->description_en }} </td>
                                    <td> {{ $rows->description_ar }} </td>
                                    <td> {{ $rows->created_at }} </td>
                                    <td> {{ $rows->updated_at }} </td>

                                    <td>
                                        <a href={{ route('categories.show' , $rows->id)}} class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                                        <a href={{ route('categories.edit', $rows->id) }} class="btn btn-primary"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a href={{ route('categories.delete' , $rows->id) }} class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
