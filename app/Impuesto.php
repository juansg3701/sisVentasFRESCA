<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
	protected $connection = 'general';
    protected $table = 'impuestos';
    protected $primaryKey='id_impuestos';
    public $timestamps =false;
    
    protected $fillable=['nombre','descripcion','valor_impuesto','sede_id_sede','empleado_id_empleado','fecha'];
    protected $guarded=[];
}