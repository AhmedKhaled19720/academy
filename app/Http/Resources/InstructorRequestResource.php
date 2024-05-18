<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructorRequestResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "cv" => $this->cv,
            "job" => $this->job,
        ];
    }
}
