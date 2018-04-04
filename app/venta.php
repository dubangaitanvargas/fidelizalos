<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
	public $timestamps = false;
    protected $guarded = [];

    public function negocio()
    {
        return $this->belongsTo('App\negocio','Negocios_idNegocios','id');

    }

    public function tipoproducto()
    	{
    		return $this->belongsTo('App\tipoproducto', 'tipoProductos_idTipoProductos', 'id');
    	}

    public function cliente()
    {
        return $this->belongsTo('App\cliente', 'clientes_idClientes', 'id');
    }
}
