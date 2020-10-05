<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $table = 'impuestos';
    protected $primaryKey='id_impuestos';
    public $timestamps =false;
    
    protected $fillable=['nombre','valor'];
    protected $guarded=[];
}