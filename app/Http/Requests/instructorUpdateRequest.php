<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class instructorUpdateRequest extends FormRequest
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
            'id' =>  [
                'required',
                ValidationRule::unique('instructors')->ignore($this->old_id),
            ],
            'name' => 'required',
            'job' => 'required',
            'description' => 'required',
            'instructor_img' => 'image',
            'email' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'please enter id.',
            'name.required' => 'please enter instructor name.',
            'instructor_img.image' => 'must be an image.',
            'job.required' => 'please enter instructor job.',
            'description.required' => 'please enter instructor description.',
            'email.required' => 'please enter instructor email.',
        ];
    }
}
