<?php

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
			$table->string('user_id');
			$table->string('group_id');
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
