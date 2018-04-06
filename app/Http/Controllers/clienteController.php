<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;


use App\Http\Requests;
use App\cliente;
use App\negocio;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\createClientRequest;

class clienteController extends Controller
{

	public function cliente(){
		$negocio = negocio::all();

		return view('cliente', [
			'negocios' => $negocio,
            'user' => Auth::user()
		]);
	}

	public function create(Request $request){
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

		$mensajes = array(
            'numIdentificacion.required' => 'Por favor escribe el numero de identificacion',
            'numIdentificacion.max' => 'El numero de documento de identificacion no puede superar los 12 caracteres',
            'numIdentificacion.unique' => 'El numero de identificacion ya existe en el sistema.',
            'nombrecliemodal.required' => 'el nombre del cliente es Requerido',
            'phone1.required' => 'El numero de celular es requerido',
            'phone1.max' => 'El numero de celular ha superado los 10 digitos ',

        );
        $validator = Validator::make($request->all(),
            [
                'numIdentificacion' => ['required', 'max:12', 'unique:clientes'],
                'nombrecliemodal' => ['required'],
                'phone1' => ['required', 'max:10'],

            ],$mensajes
        );
	   	/*var_dump($request->all()['email']);exit();*/
	   	if ($validator->fails()){
            $messages = $validator->messages();
            return response()->json(array("errors_form" => $messages),400);
        }else{
		   	$cliente = cliente::create([
		   		'numIdentificacion' => $request->all()['numIdentificacion'],
		   		'nombresClientes'  => $request->all()['nombrecliemodal'],
				'celular1'  => $request->all()['phone1'],
				'celular2'  => $request->all()['phone2'],
				'email'  => $request->all()['email'],
				'sexo' => $array['sex'],
				'fechaNacimiento' => $array['fechNacim']
				
		   	]);
				return response()->json(['id' =>$cliente->id,
					'nombre' => $cliente->nombresClientes,
					'numIdentificacion' => $cliente->numIdentificacion,
					'success' => 'Cliente registrado'
			]);
		}
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
