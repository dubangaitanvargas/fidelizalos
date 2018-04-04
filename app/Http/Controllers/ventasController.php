<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\cliente;
use App\tipoproducto;
use App\venta;
use App\negocio;
use App\Http\Requests;
use App\Http\Requests\createVentasRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class ventasController extends Controller
{
    public function home(){
    	$clientes = cliente::all();
        $tipoProductos = tipoproducto::all();
        $negocio = negocio::all();

        return view('ventas', [
            'clientes' => $clientes,
            'tipoproductos' =>  $tipoProductos,
            'negocios' => $negocio,
            'user' => Auth::user()
        ]);
    }

    public function create(Request $request){

        $mensajes = array(
            'DocuReferencia.required' => 'Por favor escribe el Documento de referencia',
            'DocuReferencia.max' => 'El numero de documento de referencia no puede superar los 25 caracteres',
            'DocuReferencia.unique' => 'El documento de referencia ya existe en el sistema.',
            'fechVenc.required' => 'La fecha de Vencimiento es Requerida',
            'tipoproduct.required' => 'El tipo de producto es Requerido',
            'idclient.required' => 'El Cliente es requerido'

            /*'unique' => ': Ya en el sistema',
            'min' => ': Su contraseña debe contener minimo 6 caracteres',
            'email' => ': Escriba un correo verdadero',
            'confirmed' => ': No coinciden las contraseñas'*/
        );
        $validator = Validator::make($request->all(),
            [
                'DocuReferencia' => ['required', 'max:25', 'unique:ventas'],
                'fechVenc' => ['required'],
                'tipoproduct' => ['required'],
                'idclient' => ['required'],

                /*'nombres' => 'required|max:255',
                'apellidos' => 'required|max:255',
                'identificacion' => 'required|max:255|unique:personas',
                'direccion' => 'required|max:255',
                'telefono' => 'required|max:255',
                'celular' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'ccargo' => 'required|exists:cargos',
                'ctiempleado' => 'required|exists:tiempleados',
                'password' => 'required|min:6|confirmed',*/
            ],$mensajes
        );
        if ($validator->fails()){
            $messages = $validator->messages();
            return response()->json(array("errors_form" => $messages),400);
        }else{

            $user = Auth::user();
            $prod = tipoproducto::all();
            $fevenc = $request->all()['fechVenc'];

            // $results = DB::select('select * from tipoProductos where id = ?', [$request->all()['tipoproduct']]);
            $results = tipoproducto::where('id', [$request->all()['tipoproduct']])->first();
            //var_dump($results[0]->diasPrimerAviso);exit();

            if ( $results ){
                if($results->ifDiasPrimeroAviso){
                    $diPri = $results->diasPrimerAviso;
                    $prim = strtotime($fevenc. $diPri . " days");
                    $prim = date("Y-m-d",$prim);
                }else{
                    $prim = null;
                }

                if($results->ifDiaSegundoAviso){
                    $diseg = $results->diasSegundoAviso;
                    $segund = strtotime($fevenc. $diseg . " days");
                    $segund = date("Y-m-d",$segund);
                }else{
                    $segund = null;
                }

                if($results->ifDiaTerceroAviso){
                    $diTer = $results->diasTercerAviso;
                    $terce = strtotime($fevenc. $diTer . " days");
                    $terce = date("Y-m-d",$terce);
                }else{
                    $terce = null;
                }
                
                if($results->ifDiaCuartoAviso){
                    $diCuar = $results->diasCuartoAviso;
                    $cuart = strtotime($fevenc. $diCuar . " days");
                    $cuart = date("Y-m-d",$cuart) ;
                }else{
                    $cuart = null;
                }

                if($results->ifDiaQuintoAviso){
                    $diQuin = $results->diasQuintoAviso;
                    $quint = strtotime($fevenc. $diQuin . " days");
                    $quint = date("Y-m-d",$quint);
                }else{
                    $quint = null;
                }
            }


    	   $venta = venta::create([

    			'fechaVentas' => $request->all()['fechVenta'],
    			'DocuReferencia' => $request->all()['DocuReferencia'],
    			'fechaVencimiento' => $request->all()['fechVenc'],
    			'necesitaRecordatorioMsg' => $request->all()['recosms'],
    			'necesitaRecordatorioEmail' => $request->all()['recoemail'],
                'tipoProductos_idTipoProductos' => $request->all()['tipoproduct'],
    			'Clientes_idClientes' => $request->all()['idclient'],
    			'negocios_idNegocios' => $user->Negocios_idNegocios,

                'fechaPrimerVencimiento' => $prim,
                'fechaSegundoVencimiento' => $segund,
                'fechaTercerVencimiento' => $terce,
                'fechaCuartoVencimiento' => $cuart,
                'fechaQuintoVencimiento' => $quint,
            ]);
            return response()->json(['success' => 'Venta Registrada']);
        }
    }

    public function obtfechVenc(Request $request){
        $prod = tipoproducto::all();
        $results = DB::select('select * from tipoproductos where id = ?', [$request->all()['tipoproduct']]);
        $feVenci = $results[0]->diasVencimiento;
        ##var_dump($request->all()['tipoproduct']);exit();
        ##var_dump($results[0]->diasVencimiento);

        return response()->json(['feVenci'=> $feVenci]);
        ##var_dump($results[0]['diasVencimiento']);
        ##$po = tipoproducto::where('id', "=", $request->all()['tipoproduct'])->get();
        ##var_dump($request->all()['tipoproduct']);
        ##var_dump($po);exit();
        ##var_dump($request->all()['tipoproduct']->$prod);exit();
    }

    public function listVent(){

        $result = venta::where('negocios_idNegocios', (Auth::user()->Negocios_idNegocios))->get();
        return view('listventas',[
            'ventas' => $result
        ]);
    }
}

