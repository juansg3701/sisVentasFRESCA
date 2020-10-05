<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class AbonoPC extends Model
{
    protected $table = 't_ab_p_cliente';
    protected $primaryKey='id_abono';
    public $timestamps =false;
    protected $fillable=['t_p_cliente_id_remision', 'abono', 'restante', 'total', 'fecha', 'empleado_id_empleado', 'tipo_pago_id_tpago','facturaPaga'];

    protected $guarded=[];
}