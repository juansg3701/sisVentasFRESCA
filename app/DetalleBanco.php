<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleBanco extends Model
{
    protected $table = 'detalle_banco';
    protected $primaryKey='id_Dbanco';
    public $timestamps =false;
    
    protected $fillable=['fecha', 'ingreso_efectivo', 'egreso_efectivo', 'banco_idBanco','ingreso_electronico','egreso_electronico','sede_id_sede'];

    protected $guarded=[];
}
