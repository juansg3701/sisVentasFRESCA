<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{	
	protected $connection = 'general';
    protected $table = 'categoria_productos';
    protected $primaryKey='id_categoria';
    public $timestamps =false;
    
    protected $fillable=['nombre','descripcion', 'empleado_id_empleado', 'sede_id_sede', 'fecha'];
    protected $guarded=[];
}