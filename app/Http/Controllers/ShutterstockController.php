<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShutterstockController extends Controller
{
    protected $data = [];
    function __construct()
    {
    	
    }
    public function index()
    {
    	return view('apps.pages.get-shutterstock', $this->data);
    }
}
