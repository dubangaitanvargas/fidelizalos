<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\cliente;
use App\venta;
use App\Http\Requests;
use App\Http\Requests\createVentasRequest;

class ventasController extends Controller
{
    public function home(){
    	$clientes = cliente::all();
    	return view('ventas', [
    		'clientes' => $clientes
    	]);
    }

    public function create(createVentasRequest $request){

    	$venta = venta::create([

    			'fechaVentas' => $request->input('fechVenta'),
    			'DocuReferencia' => $request->input('docrefe'),
    			'fechaVencimiento' => $request->input('fechVenc'),
    			'NecesitaRecordatorioMsg' => $request->input('recoemail'),
    			'NecesitaRecordatorioEmail' => $request->input('recosms'),
    			'TipoProductos_idTipoProductos' => '1',
    			'Clientes_idClientes' => '1',
    			'Negocios_idNegocios' => '1'

    		]);
    }
}
