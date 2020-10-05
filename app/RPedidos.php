<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RPedidos extends Model
{
    protected $table = 'reportepedidos';
    protected $primaryKey='id_rPedidos';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual','noProductos','total'];
    protected $guarded=[];
}
