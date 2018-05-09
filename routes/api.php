<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:05:20
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-22 11:10:31
 */
use App\Models\Movie;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('movies/{id}/update-source', 'Api\MoviesController@updateSource');
/* test */
Route::get('test/random-image', 'Api\TestController@randomImage');
Route::get('test/delete-image', 'Api\TestController@deleteImage');


Route::resource('movies', 'Api\MoviesController');
Route::resource('test', 'Api\TestController');