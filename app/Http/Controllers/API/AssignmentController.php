<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssignmentResource;
use App\Model\Assignment;
use Illuminate\Http\Request;
use App\Model\Course;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = AssignmentResource::collection(Assignment::all());
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $assignments,
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

    public function create_assignment(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);

        $validateData = Validator::make($request->all(), [
            'id' => 'unique:assignments|max:255',
            'ass_title' => 'required|string|max:255',
            'ass_description' => 'required|string',
            'ass_file' => 'nullable|file|mimes:pdf,doc,docx,txt,image',
            'deadline' => 'required|date',
            'notes' => 'nullable|string',
            'degree' => 'required|numeric|min:0',
        ]);

        if ($validateData->fails()) {
            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }

        if ($request->hasFile('ass_file')) {
            $file = $request->ass_file;
            $filename = rand(1, 1000) . time() . "." . $file->extension();
            $file->move(public_path('assignments/files/'), $filename);
        } else {
            $filename = null;
        }

        $newdata = Assignment::create([
            'id' => $request->id,
            'ass_title' => $request->input('ass_title'),
            'ass_description' => $request->input('ass_description'),
            'ass_file' => $filename,
            'deadline' => $request->input('deadline'),
            'notes' => $request->input('notes'),
            'degree' => $request->input('degree'),
            'course_id' => $course->id,
        ]);

        $data = [
            'msg' => 'Create Successfully',
            'status' => 200,
            'data' => new AssignmentResource($newdata),
        ];
        return response()->json($data);
    }


    function delete_assignment(Request $requset)
    {
        $id = $requset->id;
        $assignments = Assignment::find($id);
        if ($assignments) {
            if (File::exists(public_path('assignments/files/' . $assignments->ass_file))) {
                File::delete(public_path('assignments/files/' . $assignments->ass_file));
            }
            $assignments->delete();
            $data = [
                "msg" => "Deleted Successfully",
                "status" => "200",
                "data" => null
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => "204",
                "data" => null
            ];
            return response($data);
        }
    }


    public function update_assignments(Request $request, $courseId)
    {
        $course = Course::find($courseId);

        $old_id = $request->old_id;
        $assignments = Assignment::find($old_id);

        $validateData = Validator($request->all(), [
            'id' => 'unique:assignments|max:255',
            'ass_title' => 'required|string|max:255',
            'ass_description' => 'required|string',
            'ass_file' => 'nullable|file|mimes:pdf,doc,docx,txt,image',
            'deadline' => 'required|date',
            'notes' => 'nullable|string',
            'degree' => 'required|numeric|min:0',
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if (File::exists(public_path('assignments/files/' . $assignments->ass_file))) {
            File::delete(public_path('assignments/files/' . $assignments->ass_file));
        }
        if ($request->hasFile('ass_file')) {
            if (File::exists(public_path('assignments/files/' . $assignments->ass_file))) {
                File::delete(public_path('assignments/files/' . $assignments->ass_file));
            }
            if ($request->hasFile('ass_file')) {
                $file = $request->ass_file;
                $filename = rand(1, 1000) . time() . "." . $file->extension();
                $file->move(public_path('assignments/files/'), $filename);
            } else {
                $filename = null;
            }
            $assignments->update([
                'id' => $request->id,
                'ass_title' => $request->input('ass_title'),
                'ass_description' => $request->input('ass_description'),
                'deadline' => $request->input('deadline'),
                'degree' => $request->input('degree'),
                'notes' => $request->input('notes'),
                'course_id' => $course->id,
            ]);

            $data = [
                "msg" => "Updated Successfully",
                "status" => 200,
                "data" => $assignments
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 203,
                "data" => $assignments
            ];
            return response($data);
        }
    }
}
