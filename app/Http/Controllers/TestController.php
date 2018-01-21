<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
    	$data = [];
    	$data['name'] = 'Socola';
    	return view('test', $data);
    }
}
