<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class MovimientoSede extends Model
{
    protected $table = 'm_stock';
    protected $primaryKey='id_mstock';
    public $timestamps =false;
    
    protected $fillable=['fecha','stock_id_stock','sede_id_sede','sede_id_sede2','t_movimiento_id_tmovimiento','id_empleado'];
    protected $guarded=[];
}