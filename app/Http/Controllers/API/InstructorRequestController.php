<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorRequestResource;
use App\Model\InstructorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructorRequestController extends Controller
{
    public function index()
    {
        $instructors = InstructorRequestResource::collection(InstructorRequest::all());
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
            'name' => 'required',
            'email' => 'required|',
            'phone' => 'required|',
            'cv' => 'required|file|mimes:pdf',
            'job' => 'required',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                "msg" => "Invalid data",
                "status" => 400,
                "errors" => $validateData->errors()
            ], 400);
        }

        if ($request->hasFile('cv')) {
            $cv = $request->file('cv');
            $cvname = rand(1, 1000) . time() . "." . $cv->getClientOriginalExtension();
            $cv->move(public_path('instructorsRequests/cv/'), $cvname);
        } else {
            // return response()->json([
            //     "msg" => "CV file is required",
            //     "status" => 400,
            //     "errors" => ["cv" => ["The CV file field is required."]]
            // ], 400);

            $cvname = $request->cv;
        }

        try {
            $instructor = InstructorRequest::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'cv' => $cvname,
                'job' => $request->job,
            ]);

            return response()->json([
                'msg' => 'Instructor request created successfully',
                'status' => 201,
                'data' => new InstructorRequestResource($instructor),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "msg" => "Failed to create instructor request",
                "status" => 500,
                "errors" => $e->getMessage()
            ], 500);
        }
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
