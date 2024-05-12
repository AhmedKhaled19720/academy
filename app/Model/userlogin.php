<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class userlogin extends Model
{
    protected $fillable = [
        'id',
        "username",
        'email',
        'password',
        'created_by',
    ];
}
