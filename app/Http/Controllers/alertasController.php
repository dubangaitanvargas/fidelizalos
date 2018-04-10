<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use BulkSms;
use App\venta;
use App\cliente;
use App\envio;
use App\param;
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
        $param = "'" . $user->negocio->confsms . "'";
        $parametros = array("NAME_CLIEN" => $consult->cliente->nombresClientes,"NAME_NEGO" => $user->negocio->nombreNegocios,"PRODUC_COMP"=>$consult->tipoproducto->nombreTipoProductos,"DATE_VEN"=>$consult->fechaVencimiento, "NUM_PHONE2" => $consult->cliente->celular2, "DATE_COMP" => $consult->fechaVentas, "NUM_PHONE1" => $consult->cliente->celular1);
        

        foreach ($parametros as $key => $parametro) {
          $param = str_replace($key,$parametro, $param);
          var_dump($param);
        }
        exit();

        $text = $param;

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

        $countError = envio::where('respuestaEnvio', "0")->count();
        $countSucc = envio::where('respuestaEnvio', '1')->count();

        if ($err) {
          $this->saveenvio('1', $consult->id, '0');
          return response()->json([
            array("errors_form" => $messages),400,
            'countError' => $countError
          ]);
        } else {
          $this->saveenvio('1', $consult->id, '1');
          return response()->json([
            'success' => 'Mensajes Enviado al numero $57 ' . $consult->cliente->celular1,
            'countSucc' => $countSucc
          ]);
        }

        /*$bulkSms = new BulkSms('username', 'password', 'baseurl');
        $messageBody = 'ServisGirardot le recuerda Sr(a) '. $data['namecli'] . ' que su ' . $data["product"] . ' vence en 10 Dias. Comuniquese Al 3200000001 para mayor informacion.';
        $bulkSms::sendMessage('57'.$data["phone"], $messageBody );
        
    	return('Exito, Este mensaje Fue Enviado');*/
    }
}
