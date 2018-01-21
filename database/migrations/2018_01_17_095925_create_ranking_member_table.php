<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingMemberTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rankingMember', function (Blueprint $table) {
			$table->string('group_id');
			$table->string('user_id');
			$table->integer('posts');
			$table->integer('comments');
			$table->integer('reactions');
			$table->integer('score');
			$table->timestamps();
			$table->primary(['group_id', 'user_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('rankingMember');
	}
}
