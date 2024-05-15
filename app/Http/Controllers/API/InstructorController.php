<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorResource;
use App\Model\InstructorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = InstructorResource::collection(InstructorRequest::all());
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $instructors,
        ];
        return response()->json($data);
    }

    function create_request(Request $request)
    {

        $validateData = Validator($request->all(), [
            'id' => 'required|unique:instructor_requests|max:255',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cv' => 'required',
            'job' => 'required',
        ]);

        if ($validateData->fails()) {
            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }

        if ($request->hasFile('cv')) {
            $cv = $request->cv;
            $cvname = rand(1, 1000) . time() . "." . $cv->extension();
            $cv->move(public_path('instructorsRequests/cv/'), $cvname);
        }

        $instructors = InstructorRequest::create([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cv' => $cvname,
            'job' => $request->job,
        ]);
        $data = [
            'msg' => 'Create Successfully',
            'status' => '200',
            'data' => new InstructorResource($instructors),
        ];
        return response($data);
    }

    function delete_request(Request $requset)
    {
        $id = $requset->id;
        $instructors = InstructorRequest::find($id);
        if ($instructors) {
            if (File::exists(public_path('instructorsRequests/cv/' . $instructors->cv))) {
                File::delete(public_path('instructorsRequests/cv/' . $instructors->cv));
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
}
