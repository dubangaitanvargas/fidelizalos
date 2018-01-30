<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
