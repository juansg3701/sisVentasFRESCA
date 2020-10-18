<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	
    protected $table = 'empleado';
    protected $primaryKey='id_empleado';
    public $timestamps =false;
    
  protected $fillable=['user_id_user','nombre', 'correo', 'contrasena','tipo_cargo_id_cargo', 'sede_id_sede', 'codigo','direccion','telefono','documento','fecha'];
    protected $guarded=[];
}
