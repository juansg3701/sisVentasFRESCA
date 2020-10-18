<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey='id_cliente';
    public $timestamps =false;
    
    protected $fillable=['nombre', 'direccion', 'telefono','correo','documento','verificacion_nit','nombre_empresa','fecha','empleado_id_empleado','sede_id_sede','categoria_cliente_id_categoria'];
    protected $guarded=[];
}

