<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class ProveedorSede extends Model
{
    protected $table = 'stock';
    protected $primaryKey='id_stock';
    public $timestamps =false;
    
    protected $fillable=['producto_id_producto','sede_id_sede','proveedor_id_proveedor','disponibilidad','cantidad'];
    protected $guarded=[];
}

