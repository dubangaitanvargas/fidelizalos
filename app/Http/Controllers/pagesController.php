<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\negocio;
use App\user;
use Illuminate\Support\Facades\Auth;

class pagesController extends Controller
{
    public function home() 
    {
   		return view('index');
    }

    public function login()
    {
    	return view('login');
    }

    public  function selectNego()
    {
    	return view('selectNego', [
    		'negocios' => negocio::all()
    	]);
    }

    public function selectNegocio(Request $request){
    	//var_dump($request->all()['Negocio']);
    	//var_dump(Auth::user()->id);
    	$result = user::where('id',(Auth::user()->id))->update(['Negocios_idNegocios'=>$request->all()['Negocio']]);
    	//var_dump($result);
		//return redirect('/');
		//return (['redirect' => '/']);
    	return response()->json(['redirect' => '/']);
    	//return ($result);
    }

    public function negocioDefect(){
        $result = user::where('id',(Auth::user()->id))->update(['Negocios_idNegocios'=>'0']);
        Auth::logout();
        return redirect('/');
    }

}
