<?php

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
            $table->string('group_id');
            $table->string('user_id');
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
