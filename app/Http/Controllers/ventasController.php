<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\cliente;
use App\Http\Requests;

class ventasController extends Controller
{
    public function home(){
    	$clientes = cliente::all();
    	return view('ventas', [
    		'clientes' => $clientes
    	]);
    }

    public function create(Request $request){

    	$this->validate($request, [
    			'cliente' => 'requiere'

    		]);

    	return 'Bien!';
    }
}
