<?php
namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class DetallePP extends Model
{
    protected $table = 'd_p_proveedor';
    protected $primaryKey='id_dpproveedor';
    public $timestamps =false;
    
    protected $fillable=['cantidad', 'precio_venta', 'total', 'tp_aproveedor_id_rproveedor', 'producto_id_producto', 'descuentos_id_descuento', 'impuestos_id_impuestos'];

    protected $guarded=[];
}