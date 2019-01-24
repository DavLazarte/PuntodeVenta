<?php

namespace zitaraventas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta';

    protected $primaryKey='idventa';

    public $timestamps=false;

    protected $fillable =[
    	'idcliente',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'impuesto',
    	'total_venta',
        'sena',
        'cuota',
        'fecha_cuota',
        'saldo',
    	'estado'
    ];
    protected $guarded =[
    ];
}
