<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class FacturaCobrar extends Model
{
    protected $table = 'cartera';
    protected $primaryKey='id_cartera';
    public $timestamps =false;
    
    protected $fillable=['cuotas_totales', 'cuotas_restantes', 'cliente_id_cliente', 'empleado_id_empleado', 'total','fecha','atraso','factura_id_factura'];
    protected $guarded=[];
}

