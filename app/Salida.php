<?php

namespace zitaraventas;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $fillable = ['monto','destino','descripcion','estado'];
}
