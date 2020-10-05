<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';
    protected $primaryKey='id_factura';
    public $timestamps =false;
    
    protected $fillable=['pago_total', 'noproductos', 'tipo_pago_id_tpago','empleado_id_empleado','cliente_id_cliente','fecha','tiendaodomicilio','facturaPaga'];
    protected $guarded=[];
}

