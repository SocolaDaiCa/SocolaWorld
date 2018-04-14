<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:31
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-27 14:41:41
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBotRemindHashTagsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bot_remind_hash_tags', function (Blueprint $table) {
			$table->increments('id');
			$table->string('user_id', 20);
			$table->string('group_id', 20);
			$table->text('token');
			$table->text('messages');
			$table->text('hashtag');
			$table->boolean('active');
			$table->timestamps();
			$table->unique(['user_id', 'group_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('bot_remind_hash_tags');
	}
}
