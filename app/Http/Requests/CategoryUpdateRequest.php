<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class CategoryUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' =>  [
                'required',
                ValidationRule::unique('categories')->ignore($this->old_id),
            ],
            'title' => 'required',
            'name' => 'required',
            'description' => 'required',
            'cate_image' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'please enter id.',
            'name.required' => 'please enter category name.',
            'cate_image.image' => 'must be image.',
            'title.required' => 'please enter category title.',
            'description.required' => 'please enter category description.',
        ];
    }
}
