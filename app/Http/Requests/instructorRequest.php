<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class instructorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'id' => 'required|unique:instructors',
            'instructor_img' => 'required|image',
            'name' => 'required',
            'job' => 'required',
            'description' => 'required',
            'password' => 'required',
            'email' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'please enter id.',
            'id.unique' => 'this id must be unique',
            'name.required' => 'please enter instructor name.',
            'instructor_img.required' => 'image field is required.',
            'job.required' => 'please enter job title.',
            'description.required' => 'please enter instructor description.',
            'password.required' => 'please enter instructor password.',
            'email.required' => 'please enter instructor email.',
        ];
    }
}
