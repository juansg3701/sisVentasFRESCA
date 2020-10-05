<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class ProductosFactura extends Model
{
    protected $table = 'detalle_factura';
    protected $primaryKey='id_detallef';
    public $timestamps =false;
    
   protected $fillable=['cantidad','precio_venta','factura_id_factura', 'producto_id_producto', 'descuentos_id_descuento','impuestos_id_impuestos','total'];
     protected $guarded=[];
}