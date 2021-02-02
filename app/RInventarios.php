<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RInventarios extends Model
{
	protected $connection = 'general';
    protected $table = 'reporteinventarios';
    protected $primaryKey='id_rInventario';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual','noProductos','total'];
    protected $guarded=[];
}
