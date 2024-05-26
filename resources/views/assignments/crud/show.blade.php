@extends('layouts.master')
@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Courses</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Show course
                    Details</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a class="btn btn-info btn-icon ml-2" href=""><i class="fa-regular fa-pen-to-square fa-lg mx-2"></i></a>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <a type="button" class="btn btn-info  btn-icon ml-2" href="{{ route('courses') }}"><i
                        class="mdi mdi-backburger"></i></a>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" id="refreshPage" class="btn btn-danger  btn-icon ml-2"><i
                        class="mdi mdi-refresh"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <a type="button" class="btn btn-dark btn-icon ml-2" href="{{ route('home') }}"><i
                        class="mdi mdi-home-outline"></i></a>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
   <!-- row -->
<div class="row">
    @foreach ($assignments as $assignment)
        @php
            $remainingDays = now()->diffInDays($assignment->deadline);
            if ($remainingDays <= 3) {
                $cardClass = 'card card-danger';
            } elseif ($remainingDays <= 7) {
                $cardClass = 'card card-warning';
            } else {
                $cardClass = 'card card-primary';
            }
        @endphp

        <div class="col-md-3 mb-4">
            <div class="{{ $cardClass }}">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-0 pb-0">{{ $assignment->ass_title }}</h5>
                </div>
                <div class="card-body text-primary">
                    <p>{{ $assignment->ass_description }}</p>
                    <p>Finish in: {{ $assignment->deadline }}</p>
                    <p>Remaining: {{ $remainingDays . ' Days' }}</p>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger delete-assignment-btn"
                        data-assignment-id="{{ $assignment->id }}" data-toggle="modal"
                        data-target="#deleteModal">Delete
                    </button>
                    <a href="{{ route('assignments.show_one', ['id' => $assignment->id]) }}">
                        <i class="fa-solid fa-eye tx-16 text-info"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- row closed -->

    <!-- row closed -->

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this assignment?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <!-- Delete Assignment Form -->
                    <form id="deleteAssignmentForm" method="POST" action="{{ route('assignments.destroy', ':id') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('refreshPage').addEventListener('click', function(event) {
            event.preventDefault();
            location.reload();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete-assignment-btn').on('click', function() {
                var assignmentId = $(this).data('assignment-id');
                var deleteUrl = "{{ route('assignments.destroy', ':id') }}";
                deleteUrl = deleteUrl.replace(':id', assignmentId);

                console.log('Assignment ID:', assignmentId);
                console.log('Delete URL:', deleteUrl);

                $('#deleteAssignmentForm').attr('action', deleteUrl);
            });
        });
    </script>
@endsection
