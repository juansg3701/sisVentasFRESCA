<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetallePC extends Model
{
    protected $table = 'd_p_cliente';
    protected $primaryKey='id_dpcliente';
    public $timestamps =false;
    
    protected $fillable=['cantidad', 'precio_venta', 'total', 't_p_cliente_id_remision', 'producto_id_producto', 'descuentos_id_descuento', 'impuestos_id_impuestos'];

    protected $guarded=[];
}
