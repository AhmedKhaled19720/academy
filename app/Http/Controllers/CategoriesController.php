<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request\CategoriesRequest;
use App\Model\Categories;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    public function index()
{
    $categoriesData = Categories::all();

    return view('showallcategories', ['categoriestable' => $categoriesData]);
}

    public function show($id){
        $cateExistId = Categories::findOrFail($id);
        return view('categories.show' ,
                    [
                        'cateOneReco'=>$cateExistId
                    ]
                );
    }

    public function delete($id){
        $cateExistId = Categories::findOrFail($id);
        if(File::exists(public_path('categories/img/'.$cateExistId->cate_image))){
            File::delete(public_path('categories/img/'.$cateExistId->cate_image));
            }
        $cateExistId->delete();

        return redirect()->route('home')->with('message', 'Deleted Successfully');
    }

    public function create(){
        return view('categories.create');
    }

    public function store(CategoriesRequest $datarequest){
        $imageName = "";
        if($datarequest->hasFile("cate_image")){
                $image = $datarequest->cate_image;
                $imageName = rand(1,1000).time().".".$image->extension();
                $image->move(public_path("categories/img/"),$imageName);
            }

        Categories::create([
            'id'=>$datarequest->id,
            "cate_image" =>$imageName,
            'title_en'=>$datarequest->title_en,
            'title_ar'=>$datarequest->title_ar,
            'description_en'=>$datarequest->description_en,
            'description_ar'=>$datarequest->description_ar,
        ]);
        return redirect()->route('home')->with("message","created successfully");

    }


    public function edit($id){
        $alldata = categories::all();
        $categories = categories::findOrFail($id);
        return view("categories.edit",['categoriesedit'=>$categories,'alldata'=>$alldata]);
    }


    // public function save(categoriesUpdateRequest $saveediting){
    //     $old_id = $saveediting->old_id;
    //     $categories = categories::findOrFail($old_id);
    //     if($saveediting->hasFile("cate_image")){
    //         $image = $saveediting->cate_image;
    //         $imageName = rand(1,1000).time().".".$image->extension();
    //         if(File::exists(public_path('categories/img/'.$categories->cate_image))){
    //             File::delete(public_path('categories/img/'.$categories->cate_image));
    //             }
    //         $image->move(public_path("categories/img/"),$imageName);
    //     }else{
    //         $imageName = $categories->cate_image;
    //     }

    //     $categories->update([
    //         "id" =>$saveediting->id,
    //         "cate_image" =>$imageName,
    //         "title_en" =>$saveediting->title_en,
    //         "title_ar" =>$saveediting->title_ar,
    //         "description_en" =>$saveediting->description_en,
    //         "description_ar" =>$saveediting->description_ar,
    //     ]);

    //     return redirect()->route('home')->with("message","Updated successfully");

    // }
}
