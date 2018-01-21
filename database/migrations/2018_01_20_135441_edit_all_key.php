<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditAllKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bot_remind_hash_tags', function ($table) {
            $table->string('user_id', 20)->change();
            $table->string('group_id', 20)->change();
        });
        Schema::table('duty', function ($table) {
            $table->string('user_id', 20)->change();
            $table->string('group_id', 20)->change();
        });
        // Schema::table('insight', function ($table) {
        //     $table->string('id', 20)->change();
        // });
        Schema::table('rankingmember', function ($table) {
            $table->string('user_id', 20)->change();
            $table->string('group_id', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
