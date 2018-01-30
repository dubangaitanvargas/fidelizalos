<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use BulkSms;

class alertasController extends Controller
{
    public function alertas()
    {
    	return view('alertas');
    }

    public function sendsms()
    {
        $data = request()->all();
        $bulkSms = new BulkSms('username', 'password', 'baseurl');
        $messageBody = 'ServisGirardot le recuerda Sr(a) '. $data['namecli'] . ' que su ' . $data["product"] . ' vence en 10 Dias. Comuniquese Al 3200000001 para mayor informacion.';
        $bulkSms::sendMessage('57'.$data["phone"], $messageBody );
        
    	return('Exito, Este mensaje Fue Enviado');
    }
}
