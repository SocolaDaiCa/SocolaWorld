<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-24 18:40:53
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-10 18:05:08
 */
Route::resource('', 'AppsController');

Route::get('token', 'AppsController@getToken');

Route::resource('check-live-token', 'Apps\CheckLiveTokenController');

Route::resource('encode-decode', 'Apps\EncodeDecodeController');

Route::resource('filter-comments', 'Apps\FilterCommentsController');

Route::resource('member-checker', 'Apps\MembersCheckerController');

Route::resource('auto-beep', 'Apps\AutoBeepController');

Route::resource('ranking-member', 'Apps\RankingMemberController');

Route::resource('ranks', 'Apps\RankingMemberController');

Route::resource('post-multiple-groups', 'Apps\PostMultipleGroupsController');

Route::resource('bot-remind-hashtag','Apps\BotRemindHashTagController');

Route::resource('giveway-checker', 'Apps\GivewayChecker');

Route::resource('short-link', 'Apps\ShortLinkController');