<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
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
            "assignments_title" => $this->ass_title,
            "assignments_description" => $this->ass_description,
            "assignments_file" => $this->ass_file,
            "deadline" => $this->deadline,
            "course_id" => $this->course_id,
            "notes" => $this->notes,
            "degree" => $this->degree,
        ];
    }
}
