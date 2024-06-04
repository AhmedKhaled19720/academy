<?php

namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Userlogin extends Model implements Authenticatable, JWTSubject
{
    use AuthenticableTrait;

    protected $fillable = [
        'id',
        'username',
        'email',
        'password',
        'phone',
        'city',
        'role',
        'subscription_status',
        'created_by',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function enrolledCourses()
    {
        return $this->hasMany(EnrollCourse::class, 'user_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'user_id');
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'grades', 'user_id', 'assignment_id')
            ->withPivot('grade')
            ->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollcourses', 'user_id', 'course_id')
            ->withPivot('registration_date', 'subscription_status', 'rating')
            ->withTimestamps();
    }
}

