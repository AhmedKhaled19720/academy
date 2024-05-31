<?php


namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
        return $this->belongsToMany(Course::class, 'enrollcourses', 'user_id', 'course_id')
                    ->withPivot('registration_date', 'subscription_status');
    }
    public function assignments(): HasManyThrough
    {
        return $this->hasManyThrough(
            Assignment::class, 
            Enrollcourse::class,
            'user_id', 
            'course_id', 
            'id',    
            'course_id' 
        );
    }
}