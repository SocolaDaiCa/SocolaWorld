<?php
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

/* rank */
Route::get('rank/', 'RankingMemberController@rank')->name('site.rank');
Route::get('rank/{groupID}', 'RankingMemberController@rank');


Route::group(['prefix' => 'apps', 'middleware' => ['AppsMiddleware']], function(){
	/* token */
	Route::get('token', 'AppsController@getToken');
	/* ranking member */
	Route::group(['prefix' => 'ranking-member'],function(){
		Route::get('', 'RankingMemberController@index');
		Route::post('', 'RankingMemberController@save');
	});
	/* filter comments */
	Route::group(['prefix' => 'filter-comments'],function(){
		Route::get('', 'FilterCommentsController@index')->name('apps.filter-comments');
	});
	/* get shutterstock */
	Route::group(['prefix' => 'get-shutterstock'],function(){
		Route::get('', 'ShutterstockController@index')->name('apps.get-shutterstock');
	});
	/* auto beep*/
	Route::group(['prefix' => 'auto-beep'], function(){
		Route::get('', 'AutoBeepController@index')->name('apps.auto-beep');
	});
	/* post multiple groups */
	Route::group(['prefix' => 'post-multiple-groups'], function(){
		Route::get('', 'PostMultipleGroupsController@index')->name('apps.post-multiple-groups');
	});
	/* bot remind hashtag*/
	Route::resource('bot-remind-hashtag','BotRemindHashTagController');
	/* member checker */
	Route::get('members-checker', 'AppsMembersCheckerController@index');
});
Route::group(['prefix' => 'apps'], function(){
	Route::get('cookie-to-token', 'AppsController@cookieToToken');
	/* hôm nay ai trưc nhật*/
	Route::group(['prefix' => 'hom-nay-ai-truc-nhat'], function(){
		Route::get('', function (){
			return redirect('/apps/hom-nay-ai-truc-nhat/710340422434287');
		});
		Route::get('{groupID}', 'HomNayAiTrucNhatController@index');
		Route::post('{groupID}', 'HomNayAiTrucNhatController@get');
		Route::get('crawl/{groupID}', 'HomNayAiTrucNhatController@crawl');
		Route::post('excute-duty/{id}', 'HomNayAiTrucNhatController@excuteDuty');
		Route::post('back/{id}', 'HomNayAiTrucNhatController@back');
	});
	/* encode decode */
	Route::group(['prefix' => 'encode-decode'], function(){
		Route::get('', 'EncodeDecodeController@getIndex')->name('apps.encode-decode');
		Route::post('', 'EncodeDecodeController@postIndex');
	});
	/* check live token */
	Route::group(['prefix' => 'check-live-token'],function(){
		Route::get('', 'CheckLiveTokenController@index')->name('apps.check-live-token');
	});
	/* VSBG */
	Route::group(['prefix' => 'vsbg'],function(){
		Route::get('', 'VSBGController@index')->name('apps.vsbg');
		Route::get('load-more', 'VSBGController@loadMore');
		Route::get('crawl', 'VSBGController@crawl');
	});
});
/* API */
Route::group(['prefix' => 'api'], function (){
	Route::get('', 'ApiController@index');

	Route::get('find-my-fb-id', 'ApiController@findMyFbId');
	Route::post('find-my-fb-id', 'ApiController@findMyFbId');
	
	Route::get('get-token-facebook', 'ApiController@getTokenFacebook');
	Route::post('get-token-facebook', 'ApiController@getTokenFacebook');
	Route::get('short-link-google', 'ApiController@shortLinkGoogle');
	Route::post('short-link-google', 'ApiController@shortLinkGoogle');
});
Route::group(['prefix' => ''], function(){
	Route::get('', 'SiteController@index')->name('site.index');
	Route::get('login', 'SiteController@Login')->name('site.login');
	Route::post('login', 'SiteController@Login')->name('site.login');
	Route::get('logout', 'SiteController@logout')->name('site.logout');
});
Route::group(['prefix' => 'admin', 'middleware' => ['AppsMiddleware']], function(){
	Route::get('/', 'AdminController@index');
	Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
	Route::get('users', 'AdminController@users')->name('admin.users');
	Route::get('apps', 'AdminController@apps')->name('admin.apps');
	Route::get('apps/get/{id?}', 'AdminController@apps')->name('admin.apps');
	/* category */
	Route::get('categorys', 'AdminCategorysController@index')->name('admin.categorys');
	Route::get('categorys/all', 'AdminCategorysController@all');
	Route::resource('categorys','AdminCategorysController', ['except' => ['index']]);
});