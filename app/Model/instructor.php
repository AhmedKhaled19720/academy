<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class instructor extends Model
{
    protected $fillable = [
        'id',
        'name',
        'job',
        'email',
        'password',
        "instructor_img",
        "description",
        'instructor_facebook',
        'instructor_linkedin',
        'instructor_insta',
        'instructor_twitter',
    ];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
