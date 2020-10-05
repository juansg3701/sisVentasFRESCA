<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RInventarios2 extends Model
{
    protected $table = 'reporteinventarios2';
    protected $primaryKey='id_rInventarios';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual','noProductos','total'];
    protected $guarded=[];
}
