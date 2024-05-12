<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Model\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryResource::collection(category::all());
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $categories,
        ];
        return response()->json($data);
    }

    public function show_category($id)
    {
        $categories = category::find($id);
        if ($categories) {
            $data = [
                "msg" => "Return All Data",
                "status" => 200,
                "data" => new categoryResource($categories),
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

    function delete_category(Request $requset)
    {
        $id = $requset->id;
        $categories = category::find($id);
        if ($categories) {
            if (File::exists(public_path('categories/img/' . $categories->cate_image))) {
                File::delete(public_path('categories/img/' . $categories->cate_image));
            }
            $categories->delete();
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

    function create_category(Request $request)
    {

        $validateData = Validator($request->all(), [
            'id' => 'required|unique:categories|max:255',
            'name' => 'required',
            'cate_image' => 'required|image',
            'description' => 'required',
            'title' => 'required',
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if ($request->hasFile('cate_image')) {
            $img = $request->cate_image;
            $imgname = rand(1, 1000) . time() . "." . $img->extension();
            $img->move(public_path('categories/img/'), $imgname);
        }


        $newdata = category::create([
            'id' => $request->id,
            'name' => $request->name,
            'cate_image' => $imgname,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $data = [
            'msg' => 'Create Successfully',
            'status' => '200',
            'data' => new CategoryResource($newdata),
        ];
        return response($data);
    }

    public function update_category(Request $request)
    {

        $old_id = $request->old_id;
        $categories = category::find($old_id);

        $validateData = Validator($request->all(), [
            'id' =>  [
                'required',
                Rule::unique('categories')->ignore($old_id),
            ],
            'name' => 'required',
            'cate_image' => 'image',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if (File::exists(public_path('categories/img/' . $categories->cate_image))) {
            File::delete(public_path('categories/img/' . $categories->cate_image));
        }
        if ($categories) {
            if ($request->hasFile('cate_image')) {
                $img = $request->cate_image;
                $imgname = rand(1, 1000) . time() . "." . $img->extension();
                $img->move(public_path('categories/img/'), $imgname);
            } else {
                $imgname = $categories->cate_image;
            }
            $categories->update([
                'id' => $request->id,
                'name' => $request->name,
                'cate_image' => $imgname,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $data = [
                "msg" => "Updated Successfully",
                "status" => 200,
                "data" => $categories
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 203,
                "data" => $categories
            ];
            return response($data);
        }
    }
}
