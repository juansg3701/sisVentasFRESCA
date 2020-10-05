<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class ProductosCorte extends Model
{
    protected $table = 'd_corte';
    protected $primaryKey='id_dcorte';
    public $timestamps =false;
    
   protected $fillable=['cantidad','producto_id_producto','c_inventario_id_corte', 'fecha'];
     protected $guarded=[];
}