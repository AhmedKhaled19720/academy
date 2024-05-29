<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $fillable = [
        'course_title',
        'course_description',
        'course_img',
        'lecture_no',
        'hours_no',
        'price',
        'start_date',
        'duration',
        'level',
        'status',
        'category_id',
        'instructor_id',
    ];
    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(instructor::class);
    }

    public function assignments()
    {
        return $this->hasMany(assignment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Userlogin::class, 'enrollcourses', 'course_id', 'user_id')
                    ->withPivot('registration_date', 'subscription_status');
    }
}