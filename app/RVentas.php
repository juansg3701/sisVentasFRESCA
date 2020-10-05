<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RVentas extends Model
{
    protected $table = 'reporteventas';
    protected $primaryKey='id_rVentas';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual','noProductos','total'];
    protected $guarded=[];
}

