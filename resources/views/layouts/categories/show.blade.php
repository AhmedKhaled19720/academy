@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2 class="text-center">Show 1 Record</h2>
            <table class="m-auto text-center">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>Name</th>
                        <th>Value</th>

                    </tr>

                </thead>

                <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $cateOneReco->id }}</td>
                    </tr>
                    <tr>
                        <td>Title_En</td>
                        <td>{{ $cateOneReco->title_en }}</td>
                    </tr>
                    <tr>
                        <td>Title_Ar</td>
                        <td>{{ $cateOneReco->title_ar }}</td>
                    </tr>

                    <tr>
                        <td>Description_En</td>
                        <td>{{ $cateOneReco->description_en }}</td>
                    </tr>
                    <tr>
                        <td>Description_En</td>
                        <td>{{ $cateOneReco->description_ar }}</td>
                    </tr>

                    <tr>
                        <td>Created_At</td>
                        <td>{{ $cateOneReco->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Updated_At</td>
                        <td>{{ $cateOneReco->updated_at }}</td>
                    </tr>
                    <tr>
                        <td>
                            <a class="btn btn-primary " href={{ route('home') }}><i class="fa-solid fa-house"></i> </a>

                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection
