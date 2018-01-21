<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncodeDecodeController extends AppsController
{
    function __construct()
    {
    	parent::__construct();
    }
    public function getIndex()
    {
    	return view('apps.pages.encode-decode', $this->data);
    }
    public function postIndex(Request $request)
    {
    	$action = $request['a'];
    	$data = $request['d'];
    	return $action($data);
    }
}
