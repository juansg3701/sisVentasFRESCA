<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class PuntoVenta extends Model
{
	 protected $connection = 'general';
    protected $table = 'punto_venta';
    protected $primaryKey='id_punto_venta';
    public $timestamps =false;
    
    protected $fillable=[ 'no','nombre'];
    protected $guarded=[];
}

