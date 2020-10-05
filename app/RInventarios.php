<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RInventarios extends Model
{
    protected $table = 'reporteinventarios';
    protected $primaryKey='id_rInventarios';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual','noProductos','total'];
    protected $guarded=[];
}
