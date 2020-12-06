<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Descuentos extends Model
{
	protected $connection = 'general';
    protected $table = 'descuento';
    protected $primaryKey='id_descuento';
    public $timestamps =false;
    
    protected $fillable=['nombre','descripcion','valor_descuento','sede_id_sede','empleado_id_empleado','fecha'];
    protected $guarded=[];
}