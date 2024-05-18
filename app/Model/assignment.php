<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class assignment extends Model
{
    protected $fillable = [
        'id',
        "ass_title",
        "ass_description",
        'ass_file',
        'deadline',
        'course_id',
        'notes',
        'degree',
    ];
    public function course()
    {
        return $this->belongsTo(course::class);
    }
}
