<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'bancos';
    protected $primaryKey='id_banco';
    public $timestamps =false;
    
    protected $fillable=['nombre_banco', 'intereses', 'NoCuenta','tipo_cuenta_id_tcuenta'];
    protected $guarded=[];
}
