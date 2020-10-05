<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Rpc extends Model
{
    protected $table = 'reportepc';
    protected $primaryKey='id_rpc';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual'];
    protected $guarded=[];
}
