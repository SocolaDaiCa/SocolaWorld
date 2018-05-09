<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-04-22 07:47:17
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-30 11:26:46
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->remove('name');
        // $request = ;
        // $request->except('name');
        // $x = [
        //     'a' => '10',
        //     'b' => [
        //         'c' => '11',
        //         'd' => '12'
        //     ]
        // ];
        // unset($x->b);
        // $x->b = 1;
        // var_dump($x);
        return $request;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function randomImage()
    {
        $directory = 'F:/'.'girl/';
        $images = scandir($directory);
        $image = $directory . $images[2];
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $imageBase64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($image));

        $arr = explode('.', $image);
        $extension = array_pop($arr);
        $name = 1;
        while(file_exists('F:/'."save/{$name}.{$extension}")){
            $name++;
        }
        $newPath = "F:/save/{$name}.{$extension}";
        rename($image, $newPath);
        return $imageBase64;
    }

    public function moveImage($path)
    {
        # code...
    }

    public function deleteImage()
    {
        unlink($_GET['image']);
    }
}
