<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            'id' => 'required|unique:categories',
            'cate_image' => 'required',
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'please enter id.',
            'id.unique' => 'this id must be unique',
            'name.required' => 'please enter category name.',
            'image.required' => 'image field is required.',
            'title.required' => 'please enter category title.',
            'description.required' => 'please enter category description.',
        ];
    }
}
