<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssignmentResource;
use App\Model\assignment;
use Illuminate\Http\Request;
use App\Model\Course;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['course.enrollcourse.user'])->get(); // تصحيح الفاصلة
        $customData = $assignments->map(function ($assignment) {
            return [
                'assignment_id' => $assignment->id,
                'assignment_title' => $assignment->ass_title,
                'course_name' => $assignment->course->course_title,
                'deadline' => $assignment->deadline,
                'assignment_description' => $assignment->ass_description,
                'assignment_file' => $assignment->ass_file,
                'notes' => $assignment->notes,
                'degree' => $assignment->degree,
                'user_name' => $assignment->course->enrollcourse->first()->user->username ?? 'N/A', // التأكد من التعامل مع null
            ];
        });

        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $customData,
        ];

        return response()->json($data);
    }


    public function show_assignment($id)
    {
        $assignments = Assignment::find($id);
        if ($assignments) {
            $data = [
                "msg" => "Return All Data",
                "status" => 200,
                "data" => new AssignmentResource($assignments),
            ];
            return response()->json($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 201,
                "data" => null,
            ];
            return response()->json($data);
        }
    }
}