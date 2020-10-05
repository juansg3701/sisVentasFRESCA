<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class RBancos extends Model
{
    protected $table = 'reportebancos';
    protected $primaryKey='id_rbancos';
    public $timestamps =false;
    
    protected $fillable=['fechaInicial','fechaFinal','fechaActual'];
    protected $guarded=[];
}
