<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserloginResource;
use App\Model\userlogin;
use Dotenv\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserloginController extends Controller
{
    public function index()
    {
        $users = UserloginResource::collection(userlogin::all());
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $users,
        ];
        return response()->json($data);
    }
    public function show($id)
    {
        $users = userlogin::find($id);
        if ($users) {
            $data = [
                "msg" => "Return All Data",
                "status" => 200,
                "data" => new UserLoginResource($users),
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

    function delete(Request $requset)
    {
        $id = $requset->id;
        $users = userlogin::find($id);
        if ($users) {
            $users->delete();
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


    function create(Request $request)
    {

        $validateData = Validator($request->all(), [
            'id' => 'required|unique:userlogins|max:255',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }

        $users = userlogin::create([
            'id' => $request->id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'created_by' => $request->created_by,
        ]);

        $data = [
            "msg" => "Created Successfully",
            "status" => "200",
            "data" => new UserloginResource($users),
        ];
        return response($data);
    }

    public function update(Request $request)
    {

        $old_id = $request->old_id;
        $users = userlogin::find($old_id);

        $validateData = Validator($request->all(), [
            'id' =>  [
                'required',
                Rule::unique('userlogins')->ignore($old_id),
            ],
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }

        if ($users) {
            $users->update([
                'id' => $request->id,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $data = [
                "msg" => "updated successfully",
                "status" => 200,
                "data" => $users
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 203,
                "data" => $users
            ];
            return response($data);
        }
    }
}
