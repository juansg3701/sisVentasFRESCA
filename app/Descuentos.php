<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Descuentos extends Model
{
    protected $table = 'descuentos';
    protected $primaryKey='id_descuento';
    public $timestamps =false;
    
    protected $fillable=['nombre','caracteristica','porcentaje','sede_id_sede'];
    protected $guarded=[];
}