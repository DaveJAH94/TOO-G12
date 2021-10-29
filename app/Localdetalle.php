<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localdetalle extends Model
{
    protected $fillable = [
        'nombreLocal','capacidad','descripcion','planta','altitud','latitud'    ];
}
