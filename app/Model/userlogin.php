<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Userlogin extends Model
{
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
    
}


