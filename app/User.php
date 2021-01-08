<?php

namespace sisVentas;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
protected $connection = 'general';
protected $table='users';
protected $primaryKey='id';

    protected $fillable = [
        'name', 'email', 'password','tipo_cargo_id_cargo','sede_id_sede',
            'superusuario','punto_venta_id_punto_venta '
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
