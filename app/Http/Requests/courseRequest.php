<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class courseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id' => 'required|unique:courses',
            'course_title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'instructor_id' => 'required|exists:instructors,id',
            'course_description' => 'required|string',
            'lecture_no' => 'required|integer',
            'hours_no' => 'required|integer',
            'start_date' => 'required|date',
            'duration' => 'required|integer',
            'level' => 'required|string|in:beginner,intermediate,advanced',
            'price' => 'required|numeric',
            'course_img' => 'nullable|image',
        ];
    }
}
