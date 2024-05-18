<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserloginRequest extends FormRequest
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

            'id' => 'required|unique:userlogins',
            'email' => 'required|unique:userlogins',
            'username' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'role' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'please enter id.',
            'id.unique' => 'this id must be unique',
            'email.required' => 'please enter your email.',
            'email.unique' => 'this email is used before',
            'username.required' => 'please enter username.',
            'phone.required' => 'please enter phone.',
            'city.required' => 'please enter city.',
            'password.required' => 'please enter password.',
            'role.required' => 'please enter role.',

        ];
    }
}
