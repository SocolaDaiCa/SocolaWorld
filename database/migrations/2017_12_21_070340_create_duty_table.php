<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:31
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-27 14:33:18
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Duty;
class CreateDutyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duty', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_id', 20);
            $table->string('user_id', 20);
            $table->text('user_name');
            $table->integer('counter')->default(0);
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
        Schema::dropIfExists('duty');
    }
}
