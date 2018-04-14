<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-25 13:03:02
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-25 13:04:24
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTagToSlugCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categorys', function (Blueprint $table) {
            $table->renameColumn('tag', 'slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categorys', function (Blueprint $table) {
            $table->renameColumn('slug', 'tag');
        });
    }
}
