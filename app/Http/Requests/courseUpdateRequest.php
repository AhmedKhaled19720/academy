<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class courseUpdateRequest extends FormRequest
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
                ValidationRule::unique('courses')->ignore($this->old_id),
            ], 'course_title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'instructor_id' => 'required|exists:users,id',
            'course_description' => 'nullable|string',
            'lecture_no' => 'required|integer',
            'hours_no' => 'required|integer',
            'start_date' => 'required|date',
            'duration' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:active,disactive,archived',
            'price' => 'required|numeric',

        ];
    }
}
