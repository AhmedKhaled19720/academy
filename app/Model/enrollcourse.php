<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class enrollcourse extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'registration_date', 'subscription_status'
    ];

    public function user()
    {
        return $this->belongsTo(Userlogin::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }
}