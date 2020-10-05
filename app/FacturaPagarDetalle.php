<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class FacturaPagarDetalle extends Model
{
    protected $table = 'detalle_pagos';
    protected $primaryKey='id_dpagos';
    public $timestamps =false;
    
   protected $fillable=['fecha','valor_abono','valor_total', 'valor_restante', 'empleado_id_empleado','tipo_pago','id_cuentas'];
     protected $guarded=[];
}