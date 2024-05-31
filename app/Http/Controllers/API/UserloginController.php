<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserloginResource;
use App\Model\userlogin;
use Illuminate\Support\Facades\Validator; // Import Validator facade
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserloginController extends Controller
{
    public function index()
    {
        $users = userlogin::all()->first();
        $token = JWTAuth::fromUser($users);

        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => UserloginResource::collection(userlogin::all()),
            "token" => $token
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

    public function create(Request $request)
{
    $validateData = Validator::make($request->all(), [
        'id' => 'unique:userlogins|max:255',
        'username' => 'required',
        'email' => 'required|unique:userlogins|max:255|email',
        'password' => 'required|min:6',
        'phone' => 'required',
        'city' => 'required',
    ]);

    if ($validateData->fails()) {
        return response()->json([
            "msg" => "No Valid Data",
            "status" => 422,
            "data" => $validateData->errors()
        ], 422);
    }

    $user = userlogin::create([
        'id' => $request->id,
        'username' => $request->username,
        'email' => $request->email,
        'password' => password_hash($request->password, PASSWORD_DEFAULT),
        'phone' => $request->phone,
        'city' => $request->city,
        'role' => 'disactive', // Set a default value for the role
    ]);

    // Generate a token for the newly created user
    $token = JWTAuth::fromUser($user);

    return response()->json([
        "msg" => "Created Successfully",
        "status" => 201,
        "data" => new UserloginResource($user),
        "token" => $token
    ], 201);
}


    public function update(Request $request)
{
    $old_id = $request->old_id;
    $users = userlogin::find($old_id);

    $validateData = Validator::make($request->all(), [
        'id' =>  [
            'required',
            Rule::unique('userlogins')->ignore($old_id),
        ],
        'username' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'city' => 'required',
        'password' => 'required',
        'role' => 'required|in:active,disactive', // Ensure the role is either active or disactive
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
            'phone' => $request->phone,
            'city' => $request->city,
            'role' => $request->role, // Update the role based on request data
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
