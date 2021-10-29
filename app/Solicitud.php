<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = [
        'codigoSolicitud','fechaEnvio','tipoEvaluacion','ciclo','anio'    ];
}
