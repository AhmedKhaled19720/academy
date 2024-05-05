<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|unique:categories|max:11',
            'title_en' => 'required|min:5|max:255',
            'title_ar' => 'required|min:5|max:255',
            'description_en' => 'required|min:5|max:255',
            'description_ar' => 'required|min:5|max:255',
            //  'parent_id' => 'required',
            'cate_image' => 'required|image|max:2048|mimes:jpg,png,gif',
        ];
    }
}
