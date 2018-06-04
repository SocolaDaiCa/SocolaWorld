<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-24 14:53:03
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-05-14 14:43:47
 */
Route::resources([
	'apps'       => 'Admin\AppsController',
	'categories' => 'Admin\CategoriesController',
	'dashboard'  => 'Admin\DashboardController',
	'users'      => 'Admin\UsersController',
]);
// Route::group(['prefix' => 'admin', 'middleware' => ['AppsMiddleware']], function(){
	// Route::get('/', 'AdminController@index');
	// Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
	// Route::get('users', 'AdminController@users')->name('admin.users');
	// Route::get('apps', 'AdminController@apps')->name('admin.apps');
	// Route::get('apps/get/{id?}', 'AdminController@apps')->name('admin.apps');
	// /* category */
	// Route::get('categorys', 'AdminCategorysController@index')->name('admin.categorys');
	// Route::get('categorys/all', 'AdminCategorysController@all');
	// Route::resource('categorys','AdminCategorysController', ['except' => ['index']]);
// });