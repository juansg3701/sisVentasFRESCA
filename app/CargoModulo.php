<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class CargoModulo extends Model
{
    protected $table = 'cargo_modulo';
    protected $primaryKey='id_cargoModulo';
    public $timestamps =false;
    
    protected $fillable=['id_cargo','id_modulo'];
    protected $guarded=[];
}

