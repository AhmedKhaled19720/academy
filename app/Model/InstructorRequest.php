<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InstructorRequest extends Model
{
    protected $fillable = [
        'id',
        'name',
        'job',
        "cv",
        'email',
        'phone',
        'role',
    ];
    
}