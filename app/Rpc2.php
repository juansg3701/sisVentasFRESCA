<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Rpc2 extends Model
{
    protected $table = 'reportepc2';
    protected $primaryKey='id_rpc';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual'];
    protected $guarded=[];
}
