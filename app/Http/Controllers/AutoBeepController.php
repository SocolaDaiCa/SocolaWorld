<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutoBeepController extends Controller
{
    protected $data = [];
    function __construct()
    {
    	
    }
    public function index()
    {
    	return view('apps.pages.auto-beep');
    }
}
