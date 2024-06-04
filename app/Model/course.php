<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
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
        return $this->belongsTo(Category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'course_id');
    }

    public function students()
    {
        return $this->belongsToMany(UserLogin::class, 'enrollcourses', 'course_id', 'user_id')
            ->withPivot('registration_date', 'subscription_status');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany(EnrollCourse::class, 'course_id');
    }
}
