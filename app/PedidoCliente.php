<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class PedidoCliente extends Model
{
    protected $table = 't_p_cliente';
    protected $primaryKey='id_remision';
    public $timestamps =false;
    
    protected $fillable=['noproductos', 'fecha_solicitud', 'fecha_entrega', 'pago_inicial', 'porcentaje_venta', 'pago_total', 'cliente_id_cliente', 'empleado_id_empleado', 'tipo_pago_id_tpago'];
    protected $guarded=[];
}
