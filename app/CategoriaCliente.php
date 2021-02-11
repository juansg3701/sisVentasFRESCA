<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class CategoriaCliente extends Model
{	
	
    protected $table = 'categoria_cliente';
    protected $primaryKey='id_categoria';
    public $timestamps =false;
    protected $fillable=['nombre','no_precio','descripcion','fecha','empleado_id_empleado','sede_id_sede'];
    protected $guarded=[];
}