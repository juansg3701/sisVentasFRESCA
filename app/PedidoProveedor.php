<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedor extends Model
{
    protected $table = 'tp_aproveedor';
    protected $primaryKey='id_rproveedor';
    public $timestamps =false;
    
    protected $fillable=['noproductos', 'fecha_solicitud', 'fecha_entrega', 'pago_inicial', 'porcentaje_venta', 'pago_total', 'proveedor_id_proveedor', 'empleado_id_empleado', 'tipo_pago_id_tpago'];
    protected $guarded=[];
}
