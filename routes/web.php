<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:05:20
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-02 05:22:25
 */
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::group(['prefix' => 'apps'], function(){
// 	Route::get('cookie-to-token', 'AppsController@cookieToToken');
// 	/* hôm nay ai trưc nhật*/
// 	Route::group(['prefix' => 'hom-nay-ai-truc-nhat'], function(){
// 		Route::get('', function (){
// 			return redirect('/apps/hom-nay-ai-truc-nhat/710340422434287');
// 		});
// 		Route::get('{groupID}', 'HomNayAiTrucNhatController@index');
// 		Route::post('{groupID}', 'HomNayAiTrucNhatController@get');
// 		Route::get('crawl/{groupID}', 'HomNayAiTrucNhatController@crawl');
// 		Route::post('excute-duty/{id}', 'HomNayAiTrucNhatController@excuteDuty');
// 		Route::post('back/{id}', 'HomNayAiTrucNhatController@back');
// 	});

// 	/* check live token */
// 	Route::group(['prefix' => 'check-live-token'],function(){
// 		Route::get('', 'CheckLiveTokenController@index')->name('apps.check-live-token');
// 	});
// 	/* VSBG */
// 	Route::group(['prefix' => 'vsbg'],function(){
// 		Route::get('', 'VSBGController@index')->name('apps.vsbg');
// 		Route::get('load-more', 'VSBGController@loadMore');
// 		Route::get('crawl', 'VSBGController@crawl');
// 	});
// });
// /* API */
// Route::group(['prefix' => 'api'], function (){
// 	Route::get('', 'ApiController@index');

Route::get('find-my-fb-id', 'ApiController@findMyFbId');
Route::post('find-my-fb-id', 'ApiController@findMyFbId');
	
// 	Route::get('get-token-facebook', 'ApiController@getTokenFacebook');
// 	Route::post('get-token-facebook', 'ApiController@getTokenFacebook');
// 	Route::get('short-link-google', 'ApiController@shortLinkGoogle');
// 	Route::post('short-link-google', 'ApiController@shortLinkGoogle');
// });
// Route::group(['prefix' => ''], function(){
// });
// /* chatbot */
// Route::get('bmi/{height}/{weight}', 'Chatbot\Bmi@index');
// Route::get('sleepy-time/{timezone}', 'ChatbotController@sleepyTime');