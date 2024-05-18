<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Model\category;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = category::all();
        return view('categories.allcategories', ['category' => $categories]);
    }


    public function create()
    {
        return view('categories.crud.create');
    }

    public function save(CategoryRequest $user)
    {
        $imageName = "";
        if (request()->hasFile("cate_image")) {
            $image = request()->file("cate_image");
            $imageName = rand(1, 1000) . time() . "." . $image->extension();
            $image->move(public_path("categories/img/"), $imageName);
        }

        category::create([
            'id' => $user->id,
            "cate_image" => $imageName,
            'name' => $user->name,
            'title' => $user->title,
            'description' => $user->description,
        ]);
        session()->flash('created');
        return redirect()->route('allcategories');
    }

    public function show($id)
    {
        $categories = category::findOrFail($id);

        return view('categories.crud.show', ['category' => $categories]);
    }

    public function delete($id)
    {
        $categories = category::findOrFail($id);
        if (File::exists(public_path('categories/img/' . $categories->cate_image))) {
            File::delete(public_path('categories/img/' . $categories->cate_image));
        }
        $categories->delete();
        session()->flash('delete_category');
        return redirect()->route('allcategories');
    }

    public function edit($id)
    {
        $categories = category::findOrFail($id);
        return view('categories.crud.edit', ['category' => $categories]);
    }

    public function saveupdate(CategoryUpdateRequest $request)
    {
        $old_id = $request->old_id;
        $categories = Category::findOrFail($old_id);

        if ($request->hasFile('cate_image')) {
            if (File::exists(public_path('categories/img/' . $categories->cate_image))) {
                File::delete(public_path('categories/img/' . $categories->cate_image));
            }
            $img = $request->cate_image;
            $imgname = rand(1, 1000) . time() . "." . $img->extension();
            $img->move(public_path('categories/img/'), $imgname);
        } else {
            $imgname = $categories->cate_image;
        }

        $categories->update([
            'id' => $request->id,
            'cate_image' => $imgname,
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        session()->flash('updated');

        return redirect()->route('allcategories');
    }
}
