<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    protected $fillable = [
        'idEdificio','codigoEdificio','nombreEdificio'    ];
}
