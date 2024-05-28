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
}
