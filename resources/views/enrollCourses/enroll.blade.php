@extends('layouts.master')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">Enroll User in Course</div>
		
							<div class="card-body">
								<form method="POST" action="{{route('enrollCourse.store')}}">
									@csrf
									<div class="form-group">
										<label for="course_id">Course:</label>
										<select name="course_id" id="course_id" class="form-control">
											<option value="">Select Course</option>
											@foreach($courses as $course)
												<option value="{{ $course->id }}">{{ $course->course_title }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label for="user_id">User Name:</label>
										<select name="user_id" id="user_id" class="form-control">
											<option value="">Select User</option>
											@foreach($users as $user)
												<option value="{{ $user->id }}">{{ $user->username }}</option>
											@endforeach
										</select>
									</div>
									
									
									
		
									<button type="submit" class="btn btn-primary">Enroll User</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">Enrollments List</div>
						<div class="card-body">
							<table class="table text-md-nowrap" id="example">
								<thead>
									<tr>
										<th class="text-primary">Id</th>
										<th class="text-primary">Username</th>
										<th class="text-primary">Course Title</th>
										<th class="text-primary">Registration Date</th>
										<th class="text-primary">Status</th>
										<th class="text-primary">Created At</th>
										<th class="text-primary">Updated At</th>
										<th class="text-primary">Operation</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($alldata as $item)
									<tr>
										<td>{{ $item->id }}</td>
										<td>{{ $item->user->username }}</td>
										<td>{{ $item->course->course_title }}</td>
										<td>{{ $item->registration_date }}</td>
										<td>{{ $item->subscription_status }}</td>
										<td>{{ $item->created_at }}</td>
										<td>{{ $item->updated_at }}</td>
										<td class="d-flex">
											<a class="text-primary tx-16" href="#"><i class="fas fa-eye"></i></a>
											<a class="text-primary mx-4 tx-16" href="#"><i class="fas fa-pen-to-square"></i></a>
											<a class="text-danger tx-16" data-target="#modaldemo1" data-toggle="modal" data-user-id="{{ $item->id }}" href="#"><i class="fas fa-trash-can"></i></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- row closed -->


				<!-- row closed -->
			</div>
			<!-- Container closed -->
		
		<!-- main-content closed -->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#course_id, #user_id').select2({
            placeholder: "Select an option",
            allowClear: true 
        });
    });
</script>

@endsection