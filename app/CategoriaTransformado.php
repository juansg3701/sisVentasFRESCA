<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class CategoriaTransformado extends Model
{	
	
    protected $table = 'categoria_producto_trans';
    protected $primaryKey='id_categoria';
    public $timestamps =false;
    protected $fillable=['nombre','descripcion','fecha','empleado_id_empleado','sede_id_sede'];
    protected $guarded=[];
}