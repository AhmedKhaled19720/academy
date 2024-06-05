<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserloginResource extends JsonResource
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
            "id"=> $this->id,
            "username"=> $this->username,
            "email"=> $this->email,
            "password"=> $this->password,
            "phone"=> $this->phone,
            "city"=> $this->city,
            "role"=> $this->role,
        ];
    }
}
