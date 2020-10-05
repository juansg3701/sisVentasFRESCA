<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class AbonoPP extends Model
{
    protected $table = 'tap_proveedor';
    protected $primaryKey='id_abono';
    public $timestamps =false;
    protected $fillable=['tp_aproveedor_id_rproveedor', 'abono', 'restante', 'total', 'fecha', 'empleado_id_empleado', 'tipo_pago_id_tpago','facturaPaga'];
    protected $guarded=[];
}