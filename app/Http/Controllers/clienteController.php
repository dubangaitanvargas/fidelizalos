<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\cliente;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\createClientRequest;

class clienteController extends Controller
{
	
   public function create(createClientRequest $request){
	   	$user = Auth::user();
	   	if ($user->negocio->ifMuestraSexo)
		{
			if ($user->negocio->ifMuestraFechaNacimiento)
			{	
				$array  = array(
				'sex' => $request->all()['sex'],
				'fechNacim' => $request->all()['fechNacim'],
				);
			} else {
				
				$array  = array(
				'sex' => $request->all()['sex'],
				'fechNacim' => 'null'
				);
			}
		}else {
			if ($user->negocio->ifMuestraFechaNacimiento)
			{	
				$array  = array(
				'sex' => 'null',
				'fechNacim' => $request->all()['fechNacim'],
				);
			} else {
				$array  = array(
				'sex' => 'null',
				'fechNacim' =>'null'
				);
			}

		}
	   	/*var_dump($request->all()['email']);exit();*/

	   	$cliente = cliente::create([
	   		'numIdentificacion' => $request->all()['numidenti'],
	   		'nombresClientes'  => $request->all()['nombrecliemodal'],
			'celular1'  => $request->all()['phone1'],
			'celular2'  => $request->all()['phone2'],
			'email'  => $request->all()['email'],
			'sexo' => $array['sex'],
			'fechaNacimiento' => $array['fechNacim']
			
	   	]);
			return response()->json(['id' =>$cliente->id,
				'nombre' => $cliente->nombresClientes,
				'numIdentificacion' => $cliente->numIdentificacion
		]);
	}

	public function createp(Request $request){
		// echo $request;exit();
		return response()->json(['esto' => 'era?' ]);
	}

	public function search(Request $request) {

		$results = cliente::where('numIdentificacion', 'LIKE',  $request->all()['numident'] . '%')->first();
		return response()->json(['id' =>$results->id,
				'nombre' => $results->nombresClientes
		]);
	}

	public function searchList(Request $request){
		$result = cliente::where('numIdentificacion', 'LIKE', $request->all()['numident'] . '%' )->get();

		if( $result->isEmpty()) {
			return response()->json('error',400);
		}else{
			return response()->json($result);
		}

	}

}
