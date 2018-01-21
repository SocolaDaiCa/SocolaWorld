<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditInsightTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('insight', function (Blueprint $table) {
			$table->integer('posts')->after('id');
			$table->integer('reactions')->after('posts');
			$table->integer('comments')->after('reactions');
			$table->integer('member_active')->after('comments');
			$table->integer('member_count')->after('member_active');
			$table->string('member_top')->after('member_count');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('insight', function (Blueprint $table) {
			$table->dropColumn([
				'posts',
				'reactions',
				'comments',
				'member_active',
				'member_count',
				'member_top'
			]);
		});
	}
}
