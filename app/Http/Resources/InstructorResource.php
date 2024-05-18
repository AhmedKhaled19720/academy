<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
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
            "id" => $this->id,
            "img" => $this->instructor_img,
            "name" => $this->name,
            "job" => $this->job,
            "email" => $this->email,
            "password" => $this->password,
            "description" => $this->description,
            "facebook_url" => $this->instructor_facebook,
            "linkedin_url" => $this->instructor_linkedin,
            "instagram_url" => $this->instructor_insta,
            "twitter_url" => $this->instructor_twitter,
        ];
    }
}
