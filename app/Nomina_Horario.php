<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Nomina_Horario extends Model
{
    protected $table = 'nomina';
    protected $primaryKey='id';
    public $timestamps =false;
    
    protected $fillable=['fecha', 'horaentrada','horasalida','jornada','empleado_id_empleado','no_horas', 'pago_sem', 'hora_total','pago_total'];
    protected $guarded=[];
}
