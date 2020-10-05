<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RCaja extends Model
{
    protected $table = 'reportecaja';
    protected $primaryKey='id_rcaja';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual'];
    protected $guarded=[];
}
