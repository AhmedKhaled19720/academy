<?php

// namespace App\Model;

// use Illuminate\Database\Eloquent\Model;

// class Grade extends Model
// {
//     protected $fillable = [
//         'user_id',
//         'assignment_id',
//         'course_id',
//         'grade',
//     ];

//     public function student()
//     {
//         return $this->belongsTo(Userlogin::class, 'user_id');
//     }

//     public function assignment()
//     {
//         return $this->belongsTo(Assignment::class, 'assignment_id');
//     }

//     public function course()
//     {
//         return $this->belongsTo(Course::class, 'course_id');
//     }
// }


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'user_id',
        'assignment_id',
        'course_id',
        'grade',
    ];

    public function student()
    {
        return $this->belongsTo(Userlogin::class, 'user_id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

