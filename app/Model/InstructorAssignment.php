<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InstructorAssignment extends Model
{
    protected $table = 'instructor_assignment';

    protected $fillable = [
        'instructor_id',
        'assignment_id',
    ];
}
