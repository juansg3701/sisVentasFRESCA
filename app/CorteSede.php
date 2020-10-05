<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class CorteSede extends Model
{
    protected $table = 'c_inventario';
    protected $primaryKey='id_corte';
    public $timestamps =false;
    
   protected $fillable=['fecha','noproductos','valor_total','p_tiempo_id_tiempo','sede_id_sede'];
     protected $guarded=[];
}