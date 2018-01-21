<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterCommentsController extends AppsController
{
    function __construct()
    {
    	parent::__construct();
    }
    public function index()
    {
    	return view('apps.pages.filter-comments', $this->data);
    }
}