<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class enrollcourse extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'registration_date'
    ];

    public function user()
    {
        return $this->belongsTo(Userlogin::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'course_id', 'course_id')
                    ->where('assignment_id', '=', $this->assignment_id);
    }
}
