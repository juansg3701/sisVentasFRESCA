<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'caja';
    protected $primaryKey='id_caja';
    public $timestamps =false;
    
    protected $fillable=['base_monetaria','ingresos_efectivo','ingresos_electronicos','egresos_efectivo','egresos_electronicos','ventas','fecha','empleado_id_empleado','sede_id_sede','p_tiempo_id_tiempo'];
    protected $guarded=[];
}
