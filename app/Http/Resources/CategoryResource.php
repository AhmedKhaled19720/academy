<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            "category_id" => $this->id,
            "cate_image" => $this->cate_image,
            "category_name" => $this->name,
            "category_title" => $this->title,
            "category_description" => $this->description,
        ];
    }
}
