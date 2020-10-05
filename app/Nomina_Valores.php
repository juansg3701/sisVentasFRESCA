<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Nomina_Valores extends Model
{
    protected $table = 'tipo_cargo';
    protected $primaryKey='id_cargo';
    public $timestamps =false;
    
    protected $fillable=['nombre','descripcion','horaordinaria','horadominical','horaextra','horaextdom','fecha'];
    protected $guarded=[];
}
