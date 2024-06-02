<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
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
            "assignmentId" => $this->assignment_id,
            "courseId" => $this->course_id,
            // "course_title" => $this->course_title,
            "studentId" => $this->user_id,
            "gradeValue" => $this->grade,
        ];
    }
}
