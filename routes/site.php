<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-24 18:39:09
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-05-14 14:26:41
 */


/* index */
Route::get('', 'SiteController@index')->name('index');
/* login */
Route::get('login', 'SiteController@getLogin')->name('login');
Route::post('login', 'SiteController@Login');
Route::get('logout', 'SiteController@logout')->name('logout');
Route::get('login/facebook', 'SiteController@loginFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'SiteController@facebookCallback')->name('facebook.callback');

