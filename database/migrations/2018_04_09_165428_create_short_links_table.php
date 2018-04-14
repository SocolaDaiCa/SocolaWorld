<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-04-09 16:54:28
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-09 16:57:36
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortLinksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('short_links', function (Blueprint $table) {
			$table->increments('id');
			$table->string('slug', 20);
			$table->text('link');
			$table->string('password');
			$table->timestamps();
			/* key */
			$table->unique(['slug']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('short_links');
	}
}
