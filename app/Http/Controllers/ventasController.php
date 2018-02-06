<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\cliente;
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

    	return 'Bien!';
    }
}
