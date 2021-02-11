<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RComparar extends Model
{
	protected $connection = 'general';
    protected $table = 'reportecomparar';
    protected $primaryKey='id_rComparar';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual','noProductos','total'];
    protected $guarded=[];
}
