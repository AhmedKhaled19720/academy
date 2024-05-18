<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class settingRequest extends FormRequest
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
                ValidationRule::unique('settings')->ignore($this->old_id),
            ],
            'title_banner_1' => 'required',
            'title_banner_2' => 'required',
            'title_banner_3' => 'required',
            'caption_banner' => 'required',
            'instructor_title' => 'required',
            'instructor_caption' => 'required',
            'instructor_become_title' => 'required',
            'instructor_become_caption' => 'required',
            'discount_title_1' => 'required',
            'discount_title_2' => 'required',
            'discount_caption' => 'required',
            'discount_percent' => 'required',
            'footer_address' => 'required',
            'footer_mail' => 'required',
            'footer_phone_1' => 'required',
            'footer_phone_2' => 'required',
            'footer_facebook' => 'required',
            'footer_twitter' => 'required',
            'footer_instagram' => 'required',
            'footer_linkedin' => 'required',
            'discount_img' => 'image',

        ];
    }


}
