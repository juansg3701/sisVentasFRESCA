<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey='id_cliente';
    public $timestamps =false;
    
    protected $fillable=['nombre', 'direccion', 'telefono','correo','documento','verificacion_nit','nombre_empresa'];
    protected $guarded=[];
}

