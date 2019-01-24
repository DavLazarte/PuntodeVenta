<?php

namespace zitaraventas;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected  $fillable = ['monto_inicial','cuentas','cuotas','tarjetas','venta_efectivo','salidas','monto_final','estado'];
}
