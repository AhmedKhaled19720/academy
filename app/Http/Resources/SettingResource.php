<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title_banner_1" => $this->title_banner_1,
            "title_banner_2" => $this->title_banner_2,
            "title_banner_3" => $this->title_banner_3,
            "caption_banner" => $this->caption_banner,
            "instructor_title" => $this->instructor_title,
            "instructor_caption" => $this->instructor_caption,
            "instructor_become_title" => $this->instructor_become_title,
            "instructor_become_caption" => $this->instructor_become_caption,
            "discount_title_1" => $this->discount_title_1,
            "discount_title_2" => $this->discount_title_2,
            "discount_caption" => $this->discount_caption,
            "discount_percent" => $this->discount_percent,
            "footer_address_link" => $this->footer_address_link,
            "footer_address_iframe" => $this->footer_address_iframe,
            "footer_mail" => $this->footer_mail,
            "footer_phone_1" => $this->footer_phone_1,
            "footer_phone_2" => $this->footer_phone_2,
            "footer_facebook" => $this->footer_facebook,
            "footer_twitter" => $this->footer_twitter,
            "footer_instagram" => $this->footer_instagram,
            "footer_linkedin" => $this->footer_linkedin,
            "discount_img" => $this->discount_img,
        ];
    }
}
