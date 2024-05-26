<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUsResource;
use App\Model\contactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        $courses = contactUs::all();
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $courses,
        ];
        return response()->json($data);
    }
    function create_contact(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                "msg" => "Invalid data",
                "status" => 400,
                "errors" => $validateData->errors()
            ], 400);
        }

        try {
            $contact = contactUs::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
            ]);

            return response()->json([
                'msg' => 'Contact request created successfully',
                'status' => 201,
                'data' => new ContactUsResource($contact),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "msg" => "Failed to create contact",
                "status" => 500,
                "errors" => $e->getMessage()
            ], 500);
        }
    }

    function delete_contact(Request $requset)
    {
        $id = $requset->id;
        $contacts = contactUs::find($id);
        if ($contacts) {
            $contacts->delete();
            $data = [
                "msg" => "Deleted Successfully",
                "status" => "200",
                "data" => null
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => "404",
                "data" => null
            ];
            return response($data);
        }
    }
}
