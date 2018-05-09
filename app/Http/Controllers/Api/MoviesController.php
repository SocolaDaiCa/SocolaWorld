<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-04-21 12:33:51
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-05-09 16:08:49
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\MyClass\Imgur;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Movie::paginate(10);
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
		$data = $request->all();
		if($request->hasFile('image')){
			$data['image'] =Imgur::upload($request->file('image'));
		}
		return Movie::create($data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return Movie::find($id);
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
		$movie = Movie::findOrFail($id);
		$movie->update($request->all());
		return $movie;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$movie = Movie::find($id);
		if($movie){
			$movie->delete();
			return 204;
		}
		return 'not found';
	}

	public function updateSource($id)
	{
		$movie = Movie::findOrFail($id);

	    $get          = Curl::to($movie->link)->get();
	    $data         = explode('url\u003d', $get);
	    $url          = explode('%3Dm', $data[1]);
	    $decode       = urldecode($url[0]);
	    $linkDownload = [];
	    
	    switch (count($data)) {
	    	default: if($count <= 2) continue;
	    	case 5: $linkDownload['1080p'] = $decode . '=m37';
	    	case 4: $linkDownload['720p']  = $decode . '=m22';
	    	case 3: $linkDownload['360p']  = $decode . '=m18';
	    }
	    $movie->update(['source' => array_values($linkDownload)[0]]);

		return $movie;
	}
}
