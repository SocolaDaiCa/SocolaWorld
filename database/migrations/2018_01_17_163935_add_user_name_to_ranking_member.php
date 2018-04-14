<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:31
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-27 14:46:59
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserNameToRankingMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ranking_members', function ($table) {
            $table->text('user_name')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranking_members', function (Blueprint $table) {
            $table->dropColumn('user_name');
        });
    }
}
