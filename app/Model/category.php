<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'id',
        "name",
        "cate_image",
        'title',
        'description',
    ];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
