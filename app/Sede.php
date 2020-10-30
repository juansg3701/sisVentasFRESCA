<?php

namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

//Se define una clase para interactuar con los campos de la tabla sede en la base de datos

class Sede extends Model
{
    protected $table = 'sede';
    protected $primaryKey='id_sede';
    public $timestamps =false;  
    protected $fillable=['nombre_sede', 'ciudad', 'descripcion', 'direccion', 'telefono', 'fecha', 'empleado_id_empleado'];
    protected $guarded=[];
}

