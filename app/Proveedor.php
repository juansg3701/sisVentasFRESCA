<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey='id_proveedor';
    public $timestamps =false;
    
    protected $fillable=['nombre_empresa', 'nombre_proveedor', 'direccion','telefono','correo','documento','nit','verificacion_nit','fecha','empleado_id_empleado','sede_id_sede'];
    protected $guarded=[];
}
