<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class FacturaPagar extends Model
{
    protected $table = 'ctas_a_pagar';
    protected $primaryKey='id_ctaspagar';
    public $timestamps =false;
    
    protected $fillable=['fecha', 'nombrepago', 'descripcion', 'total', 'bancos_id_banco','cuotas_totales','empleado_id_empleado','cuotas_restantes'];
    protected $guarded=[];
}

