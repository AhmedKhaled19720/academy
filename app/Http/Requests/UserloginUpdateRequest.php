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
            'id' =>  [
                'required',
                ValidationRule::unique('userlogins')->ignore($this->old_id),
            ],
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'please enter id.',
            'id.unique' => 'this id must be unique',
            'email.required' => 'please enter your email.',
            'username.required' => 'please enter username.',
            'password.required' => 'please enter password.',
        ];
    }
}
