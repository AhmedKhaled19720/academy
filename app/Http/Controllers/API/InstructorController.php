<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorResource;
use App\Model\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = InstructorResource::collection(instructor::all());
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $instructors,
        ];
        return response()->json($data);
    }

    public function show_instructor($id)
    {
        $instructors = instructor::find($id);
        if ($instructors) {
            $data = [
                "msg" => "Return All Data",
                "status" => 200,
                "data" => new InstructorResource($instructors),
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

    function delete_instructor(Request $requset)
    {
        $id = $requset->id;
        $instructors = instructor::find($id);
        if ($instructors) {
            if (File::exists(public_path('instructors/img/' . $instructors->instructor_img))) {
                File::delete(public_path('instructors/img/' . $instructors->instructor_img));
            }
            $instructors->delete();
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

    function create_instructor(Request $request)
    {
        $validateData = Validator($request->all(), [
            'id' => 'required|unique:instructors|max:255',
            'name' => 'required',
            'instructor_img' => 'required|image',
            'description' => 'required',
            'job' => 'required',
            'email' => 'required',
        ]);

        if ($validateData->fails()) {
            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if ($request->hasFile('instructor_img')) {
            $img = $request->instructor_img;
            $imgname = rand(1, 1000) . time() . "." . $img->extension();
            $img->move(public_path('instructors/img/'), $imgname);
        }

        $newdata = instructor::create([
            'id' => $request->id,
            'name' => $request->name,
            'instructor_img' => $imgname,
            'job' => $request->job,
            'email' => $request->email,
            'password' => $request->password ?? '123', // Set a default password if not provided
            'description' => $request->description,
            'instructor_facebook' => $request->instructor_facebook,
            'instructor_linkedin' => $request->instructor_linkedin,
            'instructor_insta' => $request->instructor_insta,
            'instructor_twitter' => $request->instructor_twitter,
        ]);
        $data = [
            'msg' => 'Create Successfully',
            'status' => '200',
            'data' => new InstructorResource($newdata),
        ];
        return response($data);
    }


    public function update_instructor(Request $request)
    {
        $old_id = $request->old_id;
        $instructors = instructor::find($old_id);

        $validateData = Validator($request->all(), [
            'id' =>  [
                'required',
                Rule::unique('instructors')->ignore($old_id),
            ],
            'name' => 'required',
            'instructor_img' => 'image',
            'job' => 'required',
            'description' => 'required',
            'password' => 'required',
            'email' =>  [
                'required',
                Rule::unique('instructors')->ignore($old_id),
            ],
        ]);

        if ($validateData->fails()) {
            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }

        if ($instructors) {
            if ($request->hasFile('instructor_img')) {
                $img = $request->instructor_img;
                $imgname = rand(1, 1000) . time() . "." . $img->extension();
                $img->move(public_path('instructors/img/'), $imgname);
            } else {
                $imgname = $instructors->instructor_img;
            }
            $instructors->update([
                'id' => $request->id,
                'name' => $request->name,
                'instructor_img' => $imgname,
                'job' => $request->job,
                'email' => $request->email,
                'description' => $request->description,
                'password' => $request->password,
            ]);

            $data = [
                "msg" => "Updated Successfully",
                "status" => 200,
                "data" => $instructors
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 203,
                "data" => $instructors
            ];
            return response($data);
        }
    }

}
