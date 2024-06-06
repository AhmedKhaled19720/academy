<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class UserloginUpdateRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                ValidationRule::unique('userlogins')->ignore($this->old_id),
            ],
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'city' => 'required|string|max:255',
            'role' => 'required|in:active,disactive',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email must be unique.',
            'username.required' => 'Please enter a username.',
            'phone.required' => 'Please enter a phone number.',
            'city.required' => 'Please enter a city.',
            'role.required' => 'Please select a role.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
