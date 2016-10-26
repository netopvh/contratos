<?php

namespace CodeBase\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Adldap\Laravel\Traits\AdldapUserModelTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{

    use EntrustUserTrait,
        //if use active diretory authentication
        AdldapUserModelTrait
        ;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_super',
        'is_master',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function casas()
    {
        return $this->belongsToMany(Casa::class,'user_casas','user_id','casa_id');
    }

}
