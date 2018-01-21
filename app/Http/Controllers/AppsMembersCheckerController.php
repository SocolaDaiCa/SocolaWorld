<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppsMembersCheckerController extends AppsController
{
    public function index()
    {
    	return view('apps.members-checker', $this->data);
    }
}
