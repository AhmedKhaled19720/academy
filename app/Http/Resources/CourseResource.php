<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "courses_id" => $this->id,
            "courses_title" => $this->course_title,
            "course_description" => $this->course_description,
            "course_img" => $this->course_img,
            "hours_no" => $this->hours_no,
            "lecture_no" => $this->lecture_no,
            "price" => $this->price,
            "start_date" => $this->start_date,
            "duration" => $this->duration,
            "level" => $this->level,
            "status" => $this->status,
            "category_id" => $this->category_id,
            "instructor_id" => $this->instructor_id,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
        ];
    }
}
