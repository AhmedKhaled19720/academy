<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Resources\AssignmentResource;
use App\Model\Assignment;
use App\Model\Course;
use App\Model\enrollcourse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class EnrollCourseController extends Controller
{
  
    public function index()
    {
        $enrollments = EnrollCourse::with(['user:id,username,email', 'course:id,course_title'])->get();

        $data = $enrollments->map(function ($enrollment) {
            return [
                'user_email' => $enrollment->user->email,
                'course_title' => $enrollment->course->course_title,
                'subscription_status' => $enrollment->subscription_status,
            ];
        });
    
        $response = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $data,
        ];
    
        return response()->json($response);
    }

    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}