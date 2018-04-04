<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class negocio extends Model
{
    protected $casts = [
        'ifMuestraSexo' => 'boolean',
        'ifMuestraFechaNacimiento' => 'boolean',
    ];

    
}
