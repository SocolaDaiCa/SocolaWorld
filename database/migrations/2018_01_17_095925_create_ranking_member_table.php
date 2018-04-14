<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:31
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-27 14:44:36
 */
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
		Schema::create('ranking_members', function (Blueprint $table) {
			$table->string('group_id', 20);
			$table->string('user_id', 20);
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
		Schema::dropIfExists('ranking_members');
	}
}
