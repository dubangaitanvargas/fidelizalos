<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use BulkSms;
use App\venta;
use App\cliente;
use App\envio;
use Illuminate\Support\Facades\Auth;
///require_once(envioController);


class alertasController extends Controller
{
    function saveenvio($tipoEnvio, $idVenta, $respuestEnv){
      $date = date("Y/m/d H:i:s");
      
      $saveEnvio = envio::create([
        'fechahoraenvio' => $date,
        'tipoEnvio' => $tipoEnvio,
        'ventas_idVentas' => $idVenta,
        'respuestaEnvio' => $respuestEnv
      ]);
    }



    ##$clientproxvencer = 
    public function sendsms(Request $request)
    {
        $username = 'SistematizarLTDA';
        $password = 'stzEF3798';
        $header = "Basic " . base64_encode($username . ":" . $password);

        $consult = venta::where('id', $request->all()['id'])->first();

        $consClient = cliente::where('id', $consult->clientes_idClientes)->first();
        //var_dump($consult->cliente->nombresClientes);exit();
        $user = Auth::user();


        $text = $user->negocio->nombreNegocios . ' le recuerda Sr(a) ' . $consult->cliente->nombresClientes . ' que su ' . $consult->tipoproducto->nombreTipoProductos . ' se encuentra para vencer el: ' . $consult->fechaVencimiento . ' comuniquese al '. $user->negocio->telefono;

        $to = '57' . $consult->cliente->celular1 ;



        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{ \"from\":\"SistematizarLTDA\", \"to\":\"$to\", \"text\":\"$text\" }",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "authorization: " . $header,
            "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        if ($err) {
          $this->saveenvio('1', $consult->id, '0');
        } else {
          $this->saveenvio('1', $consult->id, '1');
          return response()->json([
            'success' => 'Mensajes Enviado al numero ' . $to
          ]);
        }

        /*$bulkSms = new BulkSms('username', 'password', 'baseurl');
        $messageBody = 'ServisGirardot le recuerda Sr(a) '. $data['namecli'] . ' que su ' . $data["product"] . ' vence en 10 Dias. Comuniquese Al 3200000001 para mayor informacion.';
        $bulkSms::sendMessage('57'.$data["phone"], $messageBody );
        
    	return('Exito, Este mensaje Fue Enviado');*/
    }
}
