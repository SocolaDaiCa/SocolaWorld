<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AppsController;

class CheckLiveTokenController extends AppsController
{
    function __construct()
    {
    	parent::__construct();
    }
    public function index()
    {
    	return view('apps.pages.check-live-token', $this->data);
    }
}
