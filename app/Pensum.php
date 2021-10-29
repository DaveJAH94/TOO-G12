<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pensum extends Model
{
    protected $fillable = [
        'codigoPensum','nombrePensum','anioCreacion'    ];
}
