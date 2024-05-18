<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class contactUs extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'message',
       
    ];
}
