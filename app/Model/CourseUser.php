<?php

namespace App\Models;

use App\Model\course;
use App\Model\userlogin;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $fillable = [
        'course_id',
        'userlogin_id',
        'registration_date',
        'subscription_status',
        'rating',
    ];

    public function course() {
        return $this->belongsTo(course::class);
    }

    public function userlogin() {
        return $this->belongsTo(userlogin::class);
    }
}

