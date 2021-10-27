<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;//pegado para los roles de usuarios con laravel permission

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;//pegado para los roles del laravel permission

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /* 'name', 'email', 'password',  este es el original , solo quite el campo name */
    protected $fillable = [
        'dui','nombre','apellido','nit','password','fechaNacimiento','estado','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
