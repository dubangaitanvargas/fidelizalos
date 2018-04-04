<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\envio;

class envioController extends Controller
{
	public function saveenvio(){
		$saveEnvio = envio::create([
			'fechahoraenvio' => date(Y/m/d H:i:s),
			'tipoEnvio' => '1',
			'ventas_idVentas' => '1',
			'respuestaEnvio' => '1'
		]);
	}

}
