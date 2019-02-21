<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-24 18:40:53
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-05-14 14:26:37
 */

Route::get('token', 'AppsController@getToken');

Route::middleware('auth')->group(function () {
	Route::resources([
		''                     => 'AppsController',
		'auto-beep'            => 'Apps\AutoBeepController',
		'bot-remind-hashtag'   => 'Apps\BotRemindHashTagController',
		'check-live-token'     => 'Apps\CheckLiveTokenController',
		'encode-decode'        => 'Apps\EncodeDecodeController',
		'filter-comments'      => 'Apps\FilterCommentsController',
		'giveway-checker'      => 'Apps\GivewayChecker',
		'member-checker'       => 'Apps\MembersCheckerController',
		'post-multiple-groups' => 'Apps\PostMultipleGroupsController',
		'ranking-member'       => 'Apps\RankingMemberController',
		'ranks'                => 'Apps\RankingMemberController',
		'short-link'           => 'Apps\ShortLinkController',
	]);
});	