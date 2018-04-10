<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class negocio extends Model
{
	public $timestamps = false;
    protected $casts = [
        'ifMuestraSexo' => 'boolean',
        'ifMuestraFechaNacimiento' => 'boolean',
        'ifenvcelular1' => 'boolean',
        'ifenvcelular2' => 'boolean',
    ];
}
