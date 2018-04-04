<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use BulkSms;
use App\venta;
use App\cliente;

class alertasController extends Controller
{
    ##$clientproxvencer = 
    public function alertas()
    {
    	return view('alertas',[
            'clientes' => cliente::all()
        ]);
    }

    /*public function sendsms()
    {
        $data = request()->all();
        $bulkSms = new BulkSms('username', 'password', 'baseurl');
        $messageBody = 'ServisGirardot le recuerda Sr(a) '. $data['namecli'] . ' que su ' . $data["product"] . ' vence en 10 Dias. Comuniquese Al 3200000001 para mayor informacion.';
        $bulkSms::sendMessage('57'.$data["phone"], $messageBody );
        
    	return('Exito, Este mensaje Fue Enviado');
    }*/

    public function sendsms(){

       $username = 'SistematizarLTD';
        $password = 'stzEF3798';
        $header = "Basic " . base64_encode($username . ":" . $password);

        /*$curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{ \"from\":\"InfoSMS\", \"to\":\"41793026727\", \"text\":\"Test SMS.\" }",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "authorization: " $header,
            "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }*/

    }

}
