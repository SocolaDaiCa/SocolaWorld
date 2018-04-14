<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-25 13:11:59
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-25 13:44:03
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForegnkeyCategoryIdToAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->unsignedInteger('category')->change();
        });

        Schema::table('apps', function (Blueprint $table) {
            $table->renameColumn('category', 'category_id');
            $table->foreign('category_id')->references('id')->on('categorys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
