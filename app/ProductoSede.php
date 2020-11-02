<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class ProductoSede extends Model
{
	 protected $connection = 'general';
    protected $table = 'producto';
    protected $primaryKey='id_producto';
    public $timestamps =false;
    
    protected $fillable=[ 'plu','ean','nombre','unidad_de_medida','precio_1','precio_2','precio_3','precio_4','costo_compra','impuestos_id_impuestos','stock_minimo','categoria_id_categoria','fecha_registro','empleado_id_empleado','necesita_peso','punto_venta_id_punto_venta','descuento_id_descuento','imagen'];
    protected $guarded=[];
}

