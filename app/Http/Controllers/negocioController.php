<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\negocio;
use Illuminate\Support\Facades\Auth;


class negocioController extends Controller
{
	
    public function paramSMS(){
    	$negocio = negocio::where('id', Auth::user()->Negocios_idNegocios )->first();
    	return view('parametrosms',[
    		'negocios' => $negocio,
    	])->with('negocios', $negocio);
    }

    public function smsSave(Request $request){
    	$result = negocio::where('id',(Auth::user()->Negocios_idNegocios))->update([
    		'confsms' => $request->all()['confsms'], 
    		/*'ifenvcelular1' => $request->all()['cel1'],
    		'ifenvcelular2' => $request->all()['cel2'],*/
    	]);
    	$negocio = negocio::where('id', Auth::user()->Negocios_idNegocios )->first();

    	return response()->json([
    		'success' => 'Cambios hechos',
    		'param' => $negocio->confsms
    	]);
    }
}
