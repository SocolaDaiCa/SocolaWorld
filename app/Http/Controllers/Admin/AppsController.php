<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-25 12:51:26
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-10 18:10:00
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\App;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AppsController extends AdminController
{
    function __construct()
    {
        parent::__construct();
        View::share('categorys', Category::all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['apps'] = $apps = App::all();
        return view('admin.pages.apps-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['method'] = 'POST';
        $data['action'] = 'Create';
        $data['route']  = route('admin.apps.store');
        return view('admin.pages.apps-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $app              = new App();
        $app->name        = $request->name;
        $app->slug        = Str::slug($app->name);
        $app->description = $request->description;
        $app->category_id = $request->category_id;
        $app->icon        = $request->icon ?? '';
        $app->save();
        return redirect()->route('admin.apps.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['method'] = 'PUT';
        $data['action'] = 'Edit';
        $data['route']  = route('admin.apps.update', $id);
        $data['app'] = App::find($id);
        return view('admin.pages.apps-create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo('destroy');
    }
}
