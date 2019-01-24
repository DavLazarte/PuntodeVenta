<?php

namespace zitaraventas;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = ['idventa','idcliente','cuota','saldo','estado'];
}
