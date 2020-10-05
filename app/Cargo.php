<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'tipo_cargo';
    protected $primaryKey='id_cargo';
    public $timestamps =false;
    
    protected $fillable=['nombre','descripcion','horaordinaria','horadominical','horaextra','fecha'];
    protected $guarded=[];
}