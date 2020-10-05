<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RPedidos2 extends Model
{
    protected $table = 'reportepedidos2';
    protected $primaryKey='id_rPedidos';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual','noProductos','total'];
    protected $guarded=[];
}
