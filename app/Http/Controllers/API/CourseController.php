<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Model\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        $courses = CourseResource::collection(course::all());
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $courses,
        ];
        return response()->json($data);
    }

    public function show_course($id)
    {
        $courses = course::find($id);
        if ($courses) {
            $data = [
                "msg" => "Return All Data",
                "status" => 200,
                "data" => new CourseResource($courses),
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
    function delete_course(Request $requset)
    {
        $id = $requset->id;
        $courses = course::find($id);
        if ($courses) {
            if (File::exists(public_path('courses/img/' . $courses->course_img))) {
                File::delete(public_path('courses/img/' . $courses->course_img));
            }
            $courses->delete();
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

    function create_course(Request $request)
    {

        $validateData = Validator($request->all(), [
            'id' => 'required|unique:courses|max:255',
            'name' => 'required',
            'course_img' => 'required|image',
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if ($request->hasFile('course_img')) {
            $img = $request->course_img;
            $imgname = rand(1, 1000) . time() . "." . $img->extension();
            $img->move(public_path('courses$courses/img/'), $imgname);
        }


        $newdata = course::create([
            'id' => $request->id,
            'name' => $request->name,
            'course_img' => $imgname,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $data = [
            'msg' => 'Create Successfully',
            'status' => '200',
            'data' => new CourseResource($newdata),
        ];
        return response($data);
    }

    public function update_category(Request $request)
    {

        $old_id = $request->old_id;
        $courses = course::find($old_id);

        $validateData = Validator($request->all(), [
            'id' =>  [
                'required',
                Rule::unique('courses')->ignore($old_id),
            ],
            'name' => 'required',
            'course_img' => 'image',
        
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if (File::exists(public_path('courses/img/' . $courses->course_img))) {
            File::delete(public_path('courses/img/' . $courses->course_img));
        }
        if ($courses) {
            if ($request->hasFile('course_img')) {
                $img = $request->course_img;
                $imgname = rand(1, 1000) . time() . "." . $img->extension();
                $img->move(public_path('courses/img/'), $imgname);
            } else {
                $imgname = $courses->course_img;
            }
            $courses->update([
                'id' => $request->id,
                'name' => $request->name,
             
            ]);

            $data = [
                "msg" => "Updated Successfully",
                "status" => 200,
                "data" => $courses
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 203,
                "data" => $courses
            ];
            return response($data);
        }
    }











}
