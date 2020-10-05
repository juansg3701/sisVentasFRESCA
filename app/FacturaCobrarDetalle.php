<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class FacturaCobrarDetalle extends Model
{
    protected $table = 'detalle_cartera';
    protected $primaryKey='id_dCartera';
    public $timestamps =false;
    
    protected $fillable=['fecha', 'valor_abono', 'valor_total', 'valor_restante', 'empleado_id_empleado','tipo_pago','id_cartera'];
    protected $guarded=[];
}

