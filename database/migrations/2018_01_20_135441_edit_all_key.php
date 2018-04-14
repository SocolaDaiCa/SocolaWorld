<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:31
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-27 14:59:42
 */
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
        Schema::table('ranking_members', function ($table) {
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
