<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssignmentResource;
use App\Model\assignment;
use App\Model\Userlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['course.enrollments.user'])->get();
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


